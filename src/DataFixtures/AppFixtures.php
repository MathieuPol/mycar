<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Car;
use App\Entity\Brand;

use Faker;

use Doctrine\DBAL\Connection;

use Faker\Provider\Fakecar;

class AppFixtures extends Fixture
{


    private $connection;
 

    public function __construct(Connection $connection)
    {
        // On récupère la connexion à la BDD (DBAL ~= PDO)
        // pour exécuter des requêtes manuelles en SQL pur
        $this->connection = $connection;

    }
    

    /**
     * Permet de TRUNCATE les tables et de remettre les Auto-incréments à 1
     */
    private function truncate()
    {
        // On passe en mode SQL ! On cause avec MySQL
        // Désactivation la vérification des contraintes FK
        $this->connection->executeQuery('SET foreign_key_checks = 0');
        // On tronque
        $this->connection->executeQuery('TRUNCATE TABLE car');
        $this->connection->executeQuery('TRUNCATE TABLE brand');
        $this->connection->executeQuery('TRUNCATE TABLE user');
        // etc.
        // Réactivation la vérification des contraintes FK
        $this->connection->executeQuery('SET foreign_key_checks = 1');
    }






    public function load(ObjectManager $manager): void
    {

        $cars = [];
        $brands = [];
        $etat = [
            1 => 'Neuf',
            2 => 'Occasion'
        ];






        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Fakecar($faker));

        for ($j= 1; $j < 6; $j++) { 
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
            $car->setFuel($faker->vehicleFuelType());
            $car->setBrand( $brands[mt_rand(0, count($brands) - 1) ] );
            $car->setDoor($faker->vehicleDoorCount);


            $randEtat = mt_rand(1,2);
            $car->setEtat($etat[$randEtat]);


            //*------------------Partie prix
            $basePrice = mt_rand(2,5);
            if($car->getEtat() == "Occasion")
            {
                $prix = $basePrice* 2500;
            }
            else( $prix = $basePrice * 10000);
            $car->setPrix($prix);
            //*--------------------------------




            $manager->persist($car);


        }





        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
