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


class MovieRatingController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        return $this->render('movieRating/index.html.twig', [
          "movies" => $movies
        ]);
    }

    /**
     * @Route("/single/{id}", name="single")
     */
    public function show(Movie $movie)
    {
        $repository = $this->getDoctrine()->getRepository(Evaluation::class);
        $evaluations = $repository->findBy(
          ["movie" => $movie],
          ["evalDate" => "DESC"],
          5,
          0
        );
        dump($evaluations);
        return $this->render('movieRating/single.html.twig', [
          "movie" => $movie,
          "evaluations" => $evaluations
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

        return $this->render('movieRating/evaluation.html.twig', [
          "movie" => $movie,
          "form" => $form->createView()
        ]);
    }
}
