<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\MovieFixtures;
use App\Entity\Evaluation;
use App\Entity\User;
use App\Entity\Movie;
use Faker;

class EvaluationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $faker = Faker\Factory::create('fr_FR');

      for ($i=0; $i < 40; $i++) {
        $evaluation = new Evaluation();
        $evaluation->setComment($faker->text($maxNbChars = 150));
        $evaluation->setGrade(random_int(0,10));
        $random = random_int(0,4);
        $evaluation->setUser($this->getReference("user"));
        $random = random_int(0,9);
        $evaluation->setMovie($this->getReference("movie"));
        $manager->persist($evaluation);
      }
        $manager->flush();
    }
  }
