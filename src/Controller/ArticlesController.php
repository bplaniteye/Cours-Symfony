<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("articles")
     */
    
     class ArticlesController extends AbstractController
    {
         /**
     * @Route("/articleform1", name="index_articleform1" , methods={"GET", "POST"})
    */
        // Ici on Fait une Enregistrement avec une Formulaire
    
    public function pageForm(Request $request, EntityManagerInterface $manager)
    {
        $articles =new Articles(); // Instanciation

        // Creation de mon Formulaire
        $form = $this->createFormBuilder($articles) 
                    ->add('titre')
                    ->add('resume')
                    ->add('contenu')
                    ->add('date')
                    ->add('image')

            // Demande le résultat
            ->getForm();

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $manager->persist($articles); 
            $manager->flush();

            return $this->redirectToRoute('index_articles', 
            ['id'=>$articles->getId()]); // Redirection vers la page
        }
       
        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('articles/articleform1.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }


    /**
     * @Route("/", name="index_articles")
     */

    // 1e Methode
    
    public function index(): Response
    {   
        $repo= $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();

        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles' => $articles,
        ]);
    }
     
    

    /**
     * @Route("/new", name="index_new_article", methods={"GET", "POST"})
     */
    public function nouveau(Request $request, EntityManagerInterface $em): Response
    {
       $articles = new Articles();
       // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
       $articles->setTitre(" Titre de mon Article");
       $articles->setImage(" photo de mon Article");
       $articles->setResume(" Titre de mon Article");
       $articles->setDate(new  \DateTime());
       $articles->setContenu(" Contenu de mon Article Contenu de mon ArticleContenu de mon ArticleContenu de mon ArticleContenu de mon Article");
       // Je persiste Mon Enregistrement
       $em->persist($articles);
       $em->flush();
       // J'envoie au niveau du temple pour l'enregistrement
       return $this->render('articles/new.html.twig', [
           'articles' => $articles,
       ]);
    }

    
    /**
     * @Route("/{id}", name="articles_affichage", methods={"GET"})
     */
    public function show(Articles $articles, ArticlesRepository $articlesRepository, Request $request, EntityManagerInterface $manager ): Response
    {
        return $this->render('articles/affichage.html.twig', [
            'id'=>$articles->getId(),
            'articles' => $articles,
        ]);
    }

}
