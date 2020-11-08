<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Job extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr');
        for ($i = 0; $i < 100; $i++) {
            $job = new \App\Entity\Job();
            $job->setDesignation($faker->jobTitle);
            $manager->persist($job);
            $jobs[$i] = $job;
        }

        $manager->flush();
    }
}
