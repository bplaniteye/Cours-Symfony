<?php

namespace App\Controller;

use App\Entity\Utilisateurs;

use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Faker;

class UtilisateursController extends AbstractController
{
    /**
     * @Route("/superadmin", name="index_admin")
     */
    public function admin(): Response
    {
        return $this->render('utilisateurs/admin.html.twig', [
            'controller_name' => 'UtilisateursController',
        ]);
    }

    /**
     * @Route("/utilisateur", name="index_utilisateur")
     */
    public function view(): Response
    {
        return $this->render('utilisateurs/utilisateur.html.twig', [
            'controller_name' => 'UtilisateursController',
        ]);
    }

    /**
     * @Route("/utilisateurs", name="index_utilisateurs")
     */
    public function index(): Response
    {
        $repo= $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateurs = $repo->findAll();

        return $this->render('utilisateurs/index.html.twig', [
            'controller_name' => 'UtilisateursController',
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * @Route("/newuser", name="index_new_utilisateur", methods={"GET", "POST"})
     */
    public function newuser(Request $request, EntityManagerInterface $em): Response
    {
        $faker = Faker\Factory::create('fr_FR');
       $utilisateurs = new Utilisateurs();
       $tab = ["admin","usager"];
       shuffle($tab);
       // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
        $utilisateurs->setNom($faker->lastName());
        $utilisateurs->setPrenom($faker->firstName()) ;   
        $utilisateurs->setDateDeNaissance (new \DateTime());
        $utilisateurs->setPhoto("Photo de profil");
        $utilisateurs->setEmail($faker->email());
        $utilisateurs->setAdresse($faker->address());
        $utilisateurs->setLogin($faker->userName()) ;                    
        $utilisateurs->setPassword("mdp");
        $utilisateurs->setRole($tab[0]) ;
       // Je persiste Mon Enregistrement
       $em->persist($utilisateurs);
       $em->flush();
       // J'envoie au niveau du temple pour l'enregistrement
       return $this->render('utilisateurs/newuser.html.twig', [
           'utilisateurs' => $utilisateurs,
       ]);
    }

    
    /**
     * @Route("/{id}", name="utilisateurs_affichage", methods={"GET"})
     */
    public function showuser(Utilisateurs $utilisateurs, UtilisateursRepository $utilisateursRepository, Request $request, EntityManagerInterface $manager ): Response
    {
        return $this->render('utilisateurs/showuser.html.twig', [
            'id'=>$utilisateurs->getId(),
            'utilisateurs' => $utilisateurs,
        ]);
    }
}
