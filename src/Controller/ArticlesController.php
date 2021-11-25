<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categorie;
use App\Form\ArticlesType;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\ORM\EntityManager;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("articles")
 */

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles_formulaire", name="index_articles_formulaire", methods={"GET","POST"})
     */
    public function articlesFormulaire2(Request $request): Response
    {
        $articles = new Articles();
        $form = $this->createForm(ArticlesType::class, $articles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articles);
            $entityManager->flush();
           return $this->redirectToRoute('index_article_affichage', ['id' => $articles->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('articles/articles_formulaire.html.twig', [
            'articles' => $articles,
            'formArticle' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article_modification/{id}", name="index_article_modification" , methods={"GET", "POST"})
     */    
    public function articleModification(Request $request, EntityManagerInterface $manager, Articles $articles)
    {
        // Creation de mon Formulaire
        $form = $this->createForm(ArticlesType::class, $articles);
        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //$manager->persist($articles);
            $manager->flush();
            return $this->redirectToRoute(
                'index_article_affichage',['id' => $articles->getId()]
            );
        }        
        return $this->render('articles/article_modification.html.twig', [
            'articles' => $articles->getId(),
            'formArticle' => $form->createView()
        ]);
    }

    /**
     * @Route("/", name="index_articles")
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
     * @Route("/{id}", name="index_article_affichage", methods={"GET", "POST"})
     */
    public function articleAffichage(Articles $articles, ArticlesRepository $articlesRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $commentaires = new Commentaires;
        $form = $this->createForm(CommentairesType::class, $commentaires);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaires);
            $articles->addCommentaire($commentaires);
            $entityManager->flush();
           return $this->redirectToRoute('index_article_affichage', ['id' => $articles->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('articles/article_affichage.html.twig', [
            'id' => $articles->getId(),
            'articles' => $articles,
            'commentairesFormulaire' => $form->createView(),
        ]);
    }
    

    /**
     * @Route("/{id}", name="index_article_suppression", methods={"GET" , "POST"})
     */
    public function articleSuppression(Request $request, Articles $articles): Response
    {
       // if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articles);
            $entityManager->flush();
       // }
        return $this->redirectToRoute('index_articles', [], Response::HTTP_SEE_OTHER);
    }

 
}
