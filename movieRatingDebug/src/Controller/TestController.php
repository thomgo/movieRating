<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Anotation\Route;
use App\Entity\Evaluation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class TestController
{
    /**
     * @Route("/home", name="index")
     */
    public function indexHome()
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class);
return $this->render('index.html.twig', [
          "movie" => $movies
]);
    }

    /**
     * @Route("/single/", name="single")
     */
    public function montrerArticle(Movie $film)
    {
                  return $this->render('test/single.html.twig', [
                    "movie" => $movie,
                  ]);
    }

    /**
     * @Route("/evaluation/{id}", name="evaluation")
     */
    public function evaluer($request, $validator)
    {
        $evaluation = new Evaluation();
        $form = $this->createForm(EvaluationType::class, $evaluation);

        if ($form->isubmitted() && $form->isvalid()) {
      $evaluation->setMovie($movie);
      $evaluation->setUser("user");
                $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evaluation);
        }

        return $this->render('movieRating/evaluation.html.twig', [
          "movie" => $movie,
          "form" => $form
        ]);
    }
}
