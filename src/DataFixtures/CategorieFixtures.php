<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
     // J'utlise fixtures avec FAKER
      $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i<20 ; $i++ ) 
        { 
            $categorie = new Categorie();
            
            $categorie->setTitre($faker->sentence())                    
                    ->setResume($faker->sentence($nbWords = 10, $variableNbWords = true));                    
            $manager->persist($categorie);
        }    
     $manager->flush();
    }
}
