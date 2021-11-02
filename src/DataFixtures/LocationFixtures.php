<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class LocationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
      
        for ($i=0; $i<100 ; $i++ ) 
        {
        $location = new location();
        $tab1 = ["Roman","Recueil", "Magazine" , "Journal"];
        shuffle($tab1);
        $tab2 = ["Disponible","Indisponible"];
        shuffle($tab2);   
        $location->setDate (new \DateTime())
        ->setTitre($faker->sentence())
        ->setCategorie($tab1[0]) 
        ->setImage("Image $i")
        ->setDescription($faker->sentence())
        ->setValeur($faker->sentence())
        ->setAdresse($faker->address())                            
        ->setAccessibility(" access $i")
        ->setALaUne("a la une $i")
        ->setSTatus($tab2[0]) ;
        $manager->persist($location);
        }
        
          

        $manager->flush();
    }
}
