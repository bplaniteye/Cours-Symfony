<?php

namespace App\Controller;

use App\Entity\Auteurs;
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
use Faker;

/**
 * @Route("articles")
 */

class ArticlesController extends AbstractController
{
         /**   
     * Affiche en details d'un arricle
     * @param AritclesRepository, $articlesrepository 
     * @Route("/articles_BD", name="articles_BD")
    */
    public function articlesAffichageBy (ArticlesRepository $articlesrepository , Articles $articles) 
    {
        // $articles = $articlesrepository->createQueryBuilder($articles)
        // ->andWhere('articles.exampleField = :val')
        // ->setParameter('val', $value)
        // ->orderBy('a.id', 'ASC')
        // ->setMaxResults(10)
        // ->getQuery()
        // ->getResult();
        {
            //throw $this->createNotFoundException('Desolé il y a Aucun Auteur pour ce id : '.$id);
            return $this->render('erreur/erreur.html.twig');
        }
        return $this->render('articles/articles_BD.html.twig' , ['articles' => $articles,]);
    }

    // CREATION DES DONNEES : ARTICLES - CATEGORIES
    /**
     * @Route("/articles_creation", name="index_articles_creation", methods={"GET", "POST"})
     */
    public function articlesCreation(Request $request, EntityManagerInterface $em): Response
    {
        $faker = Faker\Factory::create('fr_FR');
        $cat = ["Roman", "BD", "Recueil", "Essai", "Magazine", "Journal"];
        $nbcat = count($cat);
        for ($i = 0; $i < $nbcat; $i++) {
            $categories = new Categorie();
            $categories->setTitre($cat[$i]);
            $categories->setResume($cat[$i]);
            $em->persist($categories);

            for ($j = 0; $j < 10; $j++) 
            {
                $auteurs = new Auteurs;
                $auteurs->setNom($faker->lastName())
                    ->setPrenom($faker->firstName())
                    ->setEmail($faker->email())
                    ->setPassword(password_hash('mdp', PASSWORD_DEFAULT));
                $em->persist($auteurs);
              
                for ($l=0;$l<5;$l++)
                {
                    $articles = new Articles();
                    $articles->setTitre($faker->sentence())
                   ->setImage($faker->company())
                   ->setResume($faker->sentence())
                    ->setDate(new  \DateTime())
                    ->setContenu($faker->sentence())
                    ->setCategorie($categories)
                    ->setAuteurs($auteurs);
                    //->addCommentaire($commentaires);                        
                    $em->persist($articles);                  

                    for ($k = 0; $k <5; $k++) 
                    {
                        $commentaires = new Commentaires;
                        $commentaires->setAuteur($faker->firstName() . " " . $faker->lastName())
                            ->setEmail($faker->email())
                            ->setReponse($faker->sentence())
                            ->setDateheure(new \DateTime())
                            ->setArticles($articles);
                        $em->persist($commentaires);                     
                    }
                }
            }
        }
        $em->flush();
        return $this->render('articles/articles_creation.html.twig', ['articles' => $articles,]);
    }


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
                'index_article_affichage',
                ['id' => $articles->getId()]
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
     * Affiche en details d'un arricle
     * @param $id
     * @param AritclesRepository, $articlesrepository 
     * @Route("/{id}", name="articles_show", methods={"GET"})
    */
    public function articlesAffichage ($id , ArticlesRepository $articlesrepository) 
    {
        $articles = $articlesrepository->find($id);
        if (!$articles) 
        {
            //throw $this->createNotFoundException('Desolé il y a Aucun Auteur pour ce id : '.$id);
            return $this->render('erreur/erreur.html.twig');
        }
        return $this->render('articles/articles_show.html.twig' , ['articles' => $articles ,]);
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
