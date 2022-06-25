<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Car;
use App\Entity\Brand;

use Faker;

use Faker\Provider\Fakecar;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $cars = [];
        $brands = [];
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Fakecar($faker));

        for ($j= 1; $j < 4; $j++) { 
            $brand = new Brand();
            $brand->setName($faker->vehicleBrand());
            $brands[] = $brand;
            
            $manager->persist($brand);
        }


        $brandNb = count($brands);

        for ($i=1; $i < 30 ; $i++) { 

            $car = new Car();

            $car->setModele($faker->vehicleModel());
            $car->setReleasedate($faker->dateTimeBetween('-80 years'));
            $car->setBrand( $brands[mt_rand(0, count($brands) - 1) ] );

            $manager->persist($car);


        }





        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
