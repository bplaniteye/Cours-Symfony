<?php

namespace App\DataFixtures;

use App\Entity\Utilisateurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UtilisateursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i<100 ; $i++ ) 
        { 
            $tab = ["admin","usager"];
            shuffle($tab);

            $utilisateurs = new utilisateurs();
            
            $utilisateurs->setNom($faker->lastName())
                    ->setPrenom($faker->firstName())    
                    ->setDateDeNaissance (new \DateTime())
                    ->setPhoto("Photo de profil $i")
                    ->setEmail($faker->email())
                    ->setAdresse($faker->address())
                    ->setLogin($faker->userName())                     
                    ->setPassword("mdp$i")
                    ->setRole($tab[0]) ;
            $manager->persist($utilisateurs);
        }    
        $manager->flush();
    }
}
