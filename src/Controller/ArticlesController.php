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
     * @Route("/articles_formulaire1", name="index_articles_formulaire1" , methods={"GET", "POST"})
     */
    // Ici on Fait une Enregistrement avec une Formulaire

    public function articlesForm1(Request $request, EntityManagerInterface $manager)
    {
        $articles = new Articles(); // Instanciation

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

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($articles);
            $manager->flush();
            // Redirection vers la page
            return $this->redirectToRoute('articles_index', ['id' => $articles->getId()]);
        }
        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('articles/articles_formulaire1.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }

    /**
     * @Route("/articles_formulaire2", name="index_articles_formulaire2", methods={"GET","POST"})
     */
    public function articlesForm2(Request $request): Response
    {
        $articles = new Articles();
        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articles);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('articles/articles_formulaire2.html.twig', [
            'articles' => $articles,
            'formArticle' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article_modification/{id}", name="index_article_modification" , methods={"GET", "POST"})
     */
    // Ici on Fait une Enregistrement avec une Formulaire

    public function edit_article(Request $request, EntityManagerInterface $manager, Articles $articles)
    {
        // $articles = new Articles(); // Instanciation

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

        if ($form->isSubmitted() && $form->isValid()) {
            //$manager->persist($articles);
            $manager->flush();

            return $this->redirectToRoute(
                'index_article_affichage',
                ['id' => $articles->getId()]
            );
        }

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('articles/article_modification.html.twig', [
            'articles' => $articles->getId(),
            'formArticle' => $form->createView()
        ]);
    }

    /**
     * @Route("/", name="articles_index")
     */

    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repo->findAll();

        return $this->render('articles/articles_index.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/nouveau", name="index_article_nouveau", methods={"GET", "POST"})
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
        return $this->render('articles/article_nouveau.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/{id}", name="index_article_affichage", methods={"GET"})
     */
    public function show(Articles $articles, ArticlesRepository $articlesRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('articles/article_affichage.html.twig', [
            'id' => $articles->getId(),
            'articles' => $articles,
        ]);
    }
}
