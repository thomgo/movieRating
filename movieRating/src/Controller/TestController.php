<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Movie;
use App\Entity\Evaluation;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvaluationType;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class TestController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        return $this->render('test/index.html.twig', [
          "movies" => $movies
        ]);
    }

    /**
     * @Route("/single/{id}", name="single")
     */
    public function show(Movie $movie)
    {
        return $this->render('test/single.html.twig', [
          "movie" => $movie
        ]);
    }

    /**
     * @Route("/evaluation/{id}", name="evaluation")
     * @IsGranted("ROLE_USER")
     */
    public function rate(Movie $movie, Request $request, ValidatorInterface $validator)
    {
        $evaluation = new Evaluation();
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $evaluation->setMovie($movie);
          $evaluation->setUser($this->getUser());
          $errors = $validator->validate($evaluation);
          if (count($errors) > 0) {
            $this->addFlash('errors', $errors);
          }
          else {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evaluation);
            $entityManager->flush();
            $this->addFlash('success', 'Evaluation enregistrée');
          }
        }

        return $this->render('test/evaluation.html.twig', [
          "movie" => $movie,
          "form" => $form->createView()
        ]);
    }
}
