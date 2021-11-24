<?php

namespace App\Controller;

use Faker;
use App\Entity\Commentaires;
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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentairesController extends AbstractController
{

     /**
    * @Route("/commentaires_nouveaux", name="index_commentaires_nouveaux", methods={"GET","POST"})
    */

    public function commentaires(Request $request, EntityManagerInterface $em): Response
    {
      
        for ($i=0;$i<20;$i++) {
            $faker = Faker\Factory::create('fr_FR');
            $commentaires = new Commentaires;
            $commentaires->setAuteur($faker->lastName())
            ->setEmail($faker->email())
            ->setCommentaire($faker->sentence())
            ->setDate(new \DateTime());
            $em->persist($commentaires);
            $em->flush();            
        }
        return $this->render('commentaires/commentaires_nouveaux.html.twig', [
            'controller_name' => 'CommentairesController',
            'commentaires' => $commentaires
        ]);
    }


    /**
     * @Route("/commentaires", name="index_commentaires")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Commentaires::class);
        $commentaires = $repo->findall();
        return $this->render('commentaires/commentaires_index.html.twig', [
            'controller_name' => 'CommentairesController',
            'commentaires' => $commentaires
    /**
     * @Route("/commentaires", name="index_commentaires")
     */
    public function index(): Response
    {
        return $this->render('commentaires/index.html.twig', [
            'controller_name' => 'CommentairesController',
        ]);
    }

    /**
     * @Route("/commentaires_formulaire", name="index_commentaires_formulaire", methods={"GET","POST"})
     */
    public function commentairesFormulaire(Request $request): Response
    {
        $commentaires = new Commentaires();
        $form = $this->createForm(CommentairesType::class, $commentaires);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaires);
            $entityManager->flush();
           //return $this->redirectToRoute('index_auteur_affichage', ['id' => $commentaires->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('commentaires/index_articles_affichage.html.twig', [
            'commentaires' => $commentaires,
            'commentairesFormulaire' => $form->createView(),
        ]);
    }
}
