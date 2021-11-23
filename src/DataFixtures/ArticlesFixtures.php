<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


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
            $manager->persist($categorie);

            for ($j = 0; $j < 20; $j++) {
                $article = new Articles;
                shuffle($cat);
                $article->setTitre("Titre $j")
                    ->setContenu("Contenu de l'article $j")
                    ->setDate(new \DateTime())
                    ->setResume("Résumé de l'article $j")
                    ->setImage("Image de l'article $j")
                    ->setCategorie($categorie);
                $manager->persist($article);
            }
        }
        $manager->flush();
    }
}
