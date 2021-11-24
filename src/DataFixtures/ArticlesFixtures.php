<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
<<<<<<< HEAD


class ArticlesFixtures extends Fixture
{
    /*
    public function load(ObjectManager $manager): void
    {        
        for ($i=0; $i<20 ; $i++ ) 
        { 
            $articles = new Articles();            
            $articles->setTitre(" Titre de l'article N°$i ")
                    ->setContenu(" Contenu de l'article N° $i ")
                    ->setDate(new \DateTime());
            $manager->persist($articles);
        }
     $manager->flush();
    } 

public function load(ObjectManager $manager): void
    {
     // J'utlise fixtures avec FAKER
      $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i<20 ; $i++ ) 
        { 
            $articles = new Articles();
            
            $articles->setTitre($faker->sentence())
                    ->setContenu($faker->sentence($nbWords = 20, $variableNbWords = true))    
                    ->setDate(new \DateTime())
                    ->setResume($faker->sentence($nbWords = 100, $variableNbWords = true))
                    ->setImage($faker->company()) ;
            $manager->persist($articles);
        }    
     $manager->flush();
    }
*/

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $cat = ["Roman", "BD", "Recueil", "Essai", "Magazine", "Journal"];
        $nbcat = count($cat);

        for ($i = 0; $i < $nbcat; $i++) {
            $categorie = new Categorie();
            $categorie->setTitre($cat[$i])
                ->setResume("Résumé de : $cat[$i]");
=======

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $tableaucategorie = ["Roman", "BD", "Recueil", "Essai", "Magazine", "Journal"];
        $nbcat = count($tableaucategorie);
        for ($i = 0; $i < $nbcat; $i++) {
            $categorie = new Categorie();

            $categorie->setTitre($tableaucategorie[$i])
                ->setResume("Résumé de : $tableaucategorie[$i]");
>>>>>>> 8853bfe5b71795d67e2d212403a264fa0951e53f
            $manager->persist($categorie);

            for ($j = 0; $j < 5; $j++) {
                $auteurs = new Auteurs;
                $auteurs->setPrenom($faker->firstName())
                    ->setNom($faker->lastName())
                    ->setEmail($faker->email());
                $manager->persist($auteurs);

                for ($l = 0; $l < 5; $l++) {
                    $articles = new Articles;                   
                    $articles->setTitre($faker->sentence())
                        ->setContenu($faker->sentence())
                        ->setDate(new \DateTime())
                        ->setResume($faker->sentence())
                        ->setImage("Image de l'article $l")
                        ->setCategorie($categorie)
                        ->setAuteurs($auteurs);
                    $manager->persist($articles);
                }
            }
        }
        $manager->flush();
    }
}
