<?php

namespace App\DataFixtures;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0 ; $i<100 ; $i++){
            $faker = Factory::create('fr_FR');
            $property = new Property();
            $property
            ->setTitle($faker->word(3,true))
            ->setPrice($faker->numberBetween(80000,1000000))
            ->setRooms($faker->numberBetween(2,10))
            ->setBedrooms($faker->numberBetween(1,9))
            ->setDescription($faker->sentences(3,true))
            ->setSurface($faker->numberBetween(9,400))
            ->setFloor($faker->numberBetween(1,10))
            ->setCity($faker->city)
            ->setPostalCode($faker->postcode)
            ->setAddress($faker->address);

            $manager->persist($property);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
