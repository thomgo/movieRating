<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
  private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
      $faker = Faker\Factory::create('fr_FR');
      for ($i=0; $i < 5; $i++) {
        $user = new User();
        $user->setUsername($faker->lastName());
        $user->setPassword($this->passwordEncoder->encodePassword($user,"password$i"));
        $manager->persist($user);
        $this->addReference("user$i", $user);
      }
        $manager->flush();
    }
}
