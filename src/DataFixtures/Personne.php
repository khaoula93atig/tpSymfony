<?php

namespace App\DataFixtures;

use App\Entity\Hobbie;
use App\Entity\Job;
use App\Entity\PieceIdentite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Personne extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $piTypes = ['CIN', 'PASSPORT'];
        $jobs = $manager->getRepository(Job::class)->findAll();
        $hobbies = $manager->getRepository(Hobbie::class)->findAll();
        $faker = Factory::create('fr');
        for($i=0; $i<10; $i++) {
            $personne = new \App\Entity\Personne();
            $personne->setAge($faker->numberBetween(1,100));
            $personne->setName($faker->lastName);
            $personne->setFirstname($faker->firstName);
            $personne->setPath($faker->imageUrl());
            for($j = 1; $j < $faker->numberBetween(1,7) ; $j++ ){
                $personne->addHobby($hobbies[$faker->numberBetween(0, count($hobbies)-1)]);
            }
            $personne->setJob($jobs[$faker->numberBetween(0, count($jobs)-1)]);
            $pieceIdentite = new PieceIdentite();
            $pieceIdentite->setIdentifiant($faker->randomNumber(8));
            $pieceIdentite->setType($piTypes[$i%2]);
            $personne->setPieceIdentite($pieceIdentite);
            $manager->persist($personne);

        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            \App\DataFixtures\Job::class,
            \App\DataFixtures\Hobbie::class
        ];
    }
}
