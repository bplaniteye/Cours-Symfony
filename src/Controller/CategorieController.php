<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Articles;
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
     * @Route("/categorieform1", name="index_categorieform1" , methods={"GET", "POST"})
     */
    // Ici on Fait une Enregistrement avec une Formulaire

    public function categorieForm1(Request $request, EntityManagerInterface $manager)
    {
        $categorie = new Categorie(); // Instanciation

        // Creation de mon Formulaire
        $form = $this->createFormBuilder($categorie)
            ->add('titre')
            ->add('resume')            
            ->getForm(); // Demande le résultat

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute(
                'index_categorie',
                ['id' => $categorie->getId()]
            ); // Redirection vers la page
        }

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('categorie/categorieform1.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }

    /**
     * @Route("/categorieform2", name="index_categorieform2", methods={"GET","POST"})
     */
    public function categorieForm2(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('index_categorie', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('categorie/categorieform2.html.twig', [
            'categorie' => $categorie,
            'formCategorie' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit_categorie/ {id}", name="index_edit_categorie" , methods={"GET", "POST"})
     */
    // Ici on Fait une Enregistrement avec une Formulaire

    public function edit_categorie(Request $request, EntityManagerInterface $manager , Categorie $categorie)
    {
        //$categorie = new Categorie(); // Instanciation

        // Creation de mon Formulaire
        $form = $this->createFormBuilder($categorie)
            ->add('titre')
            ->add('resume')            
            ->getForm(); // Demande le résultat

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute(
                'index_showcategorie',
                ['id' => $categorie->getId()]
            ); // Redirection vers la page
        }

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('categorie/edit_categorie.html.twig', [
            'categorie' => $categorie->getId(),
            'formCategorie' => $form->createView()
        ]);
    }

    /**
     * @Route("/categorie", name="index_categorie")
     */
    public function index(): Response
    {   
        $repo= $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->findAll();

        return $this->render('categorie/index_categories.html.twig', [
            'controller_name' => 'CategorieController',
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/newcategorie", name="index_newcategorie", methods={"GET", "POST"})
     */
    public function newcategorie(Request $request, EntityManagerInterface $em): Response
    {
        $faker = Faker\Factory::create('fr_FR');
       $categorie = new Categorie();       
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
     * @Route("showcategorie/{id}", name="index_showcategorie", methods={"GET"})
     */
    public function showcategorie(Categorie $categorie, CategorieRepository $categorieRepository, Request $request, EntityManagerInterface $manager ): Response
    {
        return $this->render('categorie/showcategorie.html.twig', [
            'id'=>$categorie->getId(),
            'categorie' => $categorie,
        ]);
    }
}
