<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Auteurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Faker;

class AuteursController extends AbstractController
{
       /**
     * @Route("/auteurs", name="index_auteurs")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Auteurs::class);
        $auteurs = $repo->findAll();
        return $this->render('auteurs/auteurs_index.html.twig', [
            'controller_name' => 'AuteursController',
            'auteurs' => $auteurs
        ]);
    }
  

    /**
    * @Route("/auteurs", name="index_auteurs_nouveaux", methods={"GET","POST"})
    */

    public function auteurs(Request $request, EntityManagerInterface $em): Response
    {
      
        for ($i=0;$i<20;$i++) {
            $faker = Faker\Factory::create('fr_FR');
            $auteurs = new Auteurs;
            $auteurs->setNom($faker->lastName())
            ->setPrenom($faker->firstName())
            ->setEmail($faker->email());
            $em->persist($auteurs);
            $em->flush();            
        }
        return $this->render('auteurs/auteurs_nouveaux.html.twig', [
            'controller_name' => 'AuteursController',
            'auteurs' => $auteurs
        ]);
    }

   
   
}
