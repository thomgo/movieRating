<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use Faker;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $faker = Faker\Factory::create('fr_FR');

      for ($i=0; $i < 10; $i++) {
        $movie = new Movie();
        $movie->setTitle($faker->realText($maxNbChars = 30, $indexSize = 1));
        $movie->setSumary($faker->text($maxNbChars = 800));
        $movie->setReleaseYear(new \DateTime($faker->date($format = 'd-m-Y', $max = 'now')));
        $movie->setType("Horror");
        $movie->setAuthor($faker->firstNameMale() . " " . $faker->lastName());
        $manager->persist($movie);
        $this->addReference("movie$i", $movie);
      }
        $manager->flush();
    }
}
