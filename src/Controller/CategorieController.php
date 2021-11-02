<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker; 

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="index_categorie")
     */
    public function index(): Response
    {   
        $repo= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->findAll();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/newcategorie", name="index_newcategorie", methods={"GET", "POST"})
     */
    public function newuser(Request $request, EntityManagerInterface $em): Response
    {
        $faker = Faker\Factory::create('fr_FR');
       $categorie = new Categorie();
       $tab = ["admin","usager"];
       shuffle($tab);
       // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
        $categorie->setTitre($faker->sentence());
        $categorie->setResume($faker->sentence()) ;        
       // Je persiste Mon Enregistrement
       $em->persist($categorie);
       $em->flush();
       // J'envoie au niveau du temple pour l'enregistrement
       return $this->render('categorie/newcategorie.html.twig', [
           'categorie' => $categorie,
       ]);
    }

    
    /**
     * @Route("/{id}", name="index_showcategorie", methods={"GET"})
     */
    public function showcategorie(Categorie $categorie, CategorieRepository $categorieRepository, Request $request, EntityManagerInterface $manager ): Response
    {
        return $this->render('categorie/showcategorie.html.twig', [
            'id'=>$categorie->getId(),
            'categorie' => $categorie,
        ]);
    }
}
