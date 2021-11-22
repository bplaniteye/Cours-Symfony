<?php

namespace App\Controller;

use Faker;
use App\Entity\Commentaires;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentairesController extends AbstractController
{

     /**
    * @Route("/", name="index_commentaires_nouveaux", methods={"GET","POST"})
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
        ]);
    }
}
