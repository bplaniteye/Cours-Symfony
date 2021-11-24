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
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $tableaucategorie = ["Roman", "BD", "Recueil", "Essai", "Magazine", "Journal"];
        $nbcat = count($tableaucategorie);
        for ($i = 0; $i < $nbcat; $i++) {
            $categorie = new Categorie();

            $categorie->setTitre($tableaucategorie[$i])
                ->setResume("Résumé de : $tableaucategorie[$i]");
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
