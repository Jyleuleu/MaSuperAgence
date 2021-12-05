<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 100; $i++) { 
            # code...
            $property = new Property();

            $property
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3, true))
                ->setSurface($faker->numberBetween(11, 300))
                ->setRooms($faker->numberBetween(1,10))
                ->setBedrooms($faker->numberBetween(1,5))
                ->setFloor($faker->numberBetween(0,10))
                ->setPrice($faker->numberBetween(100000, 350000))
                ->setHeat($faker->numberBetween(0,4))
                ->setPostalCode($faker->postcode)
                ->setCity($faker->city)
                ->setAddress($faker->address);

            $manager->persist($property);
        }

        $manager->flush();
    }
}
