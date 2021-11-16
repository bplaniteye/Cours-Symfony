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
     * @Route("/admin", name="index_admin")
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
     * @Route("/utilisateurs_form1", name="index_utilisateurs_form1" , methods={"GET", "POST"})
     */
    // Ici on Fait une Enregistrement avec une Formulaire

    public function utilisateursForm1(Request $request, EntityManagerInterface $manager)
    {
        $utilisateurs = new Utilisateurs(); // Instanciation

        // Creation de mon Formulaire
        $form = $this->createFormBuilder($utilisateurs)
            ->add('nom')
            ->add('prenom')
            ->add('date_de_naissance')
            ->add('photo')
            ->add('email')
            ->add('adresse')
            ->add('login')
            ->add('password')
            ->add('role')         

            // Demande le résultat
            ->getForm();

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($utilisateurs);
            $manager->flush();

            return $this->redirectToRoute('index_affichage_utilisateur', ['id' => $utilisateurs->getId()]); // Redirection vers la page
        }

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('utilisateurs/utilisateurs_form1.html.twig', [
            'formUtilisateurs' => $form->createView()
        ]);
    }

    /**
     * @Route("/utilisateurs_form2", name="index_utilisateurs_form2", methods={"GET","POST"})
     */
    public function utilisateursForm2(Request $request): Response
    {
        $utilisateurs = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $utilisateurs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateurs);
            $entityManager->flush();

            return $this->redirectToRoute('index_affichage_utilisateur', ['id' => $utilisateurs->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateurs/utilisateurs_form2.html.twig', [
            'utilisateurs' => $utilisateurs,
            'formUtilisateurs' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit_utilisateur/{id}" , name="index_edit_utilisateur", methods= {"GET","POST"})
     */
    public function edit_utilisateur (Request $request, Utilisateurs $utilisateurs) : Response {

        $form= $this->createForm(UtilisateursType::class , $utilisateurs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('index_affichage_utilisateur' , ['id'=> $utilisateurs->getId()]);
        }
        return $this->render('utilisateurs/edit_utilisateur.html.twig', ['utilisateurs'=> $utilisateurs->getId(), 
        'formUtilisateurs'=>$form->createView(),
    ]);
    }

    /**
     * @Route("/supprimer_utilisateur/{id}" , name="index_supprimer_utilisateur", methods= {"GET","POST"})
     */
    public function supprimer_utilisateur (Request $request, Utilisateurs $utilisateurs , EntityManagerInterface $entityManager) : Response {     
      
            $entityManager->remove($utilisateurs);
            $entityManager->flush();
            return $this->redirectToRoute('index_utilisateurs'); 
    }

    /**
     * @Route("/utilisateurs", name="index_utilisateurs")
     */
    public function index(): Response
    {
        $repo= $this->getDoctrine()->getRepository(Utilisateurs::class);
        $utilisateurs = $repo->findAll();

        return $this->render('utilisateurs/index_utilisateurs.html.twig', [
            'controller_name' => 'UtilisateursController',
            'utilisateurs' => $utilisateurs,
        ]);
    }

    /**
     * @Route("/nouvel_utilisateur", name="index_nouvel_utilisateur", methods={"GET", "POST"})
     */
    public function nouvelUtilisateur(Request $request, EntityManagerInterface $em): Response
    {
        $faker = Faker\Factory::create('fr_FR');
       $utilisateurs = new Utilisateurs();
       $tab = ["admin","usager"];
       shuffle($tab);
       // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
       /*
        $utilisateurs->setNom($faker->lastName());
        $utilisateurs->setPrenom($faker->firstName()) ;   
        $utilisateurs->setDateDeNaissance (new \DateTime());
        $utilisateurs->setPhoto("Photo de profil");
        $utilisateurs->setEmail($faker->email());
        $utilisateurs->setAdresse($faker->address());
        $utilisateurs->setLogin($faker->userName()) ;                    
        $utilisateurs->setPassword("mdp");
        $utilisateurs->setRole($tab[0]) ;
        */
        $utilisateurs->setNom("");
        $utilisateurs->setPrenom("") ;   
        $utilisateurs->setDateDeNaissance (new \DateTime());
        $utilisateurs->setPhoto("Photo de profil");
        $utilisateurs->setEmail("email");
        $utilisateurs->setAdresse("0");
        $utilisateurs->setLogin("login") ;                    
        $utilisateurs->setPassword("mdp");
        $utilisateurs->setRole($tab[0]) ;
       // Je persiste Mon Enregistrement
       
       $em->persist($utilisateurs);
       $em->flush();
       // J'envoie au niveau du temple pour l'enregistrement
       return $this->render('utilisateurs/nouvel_utilisateur.html.twig', [
           'utilisateurs' => $utilisateurs,
       ]);
    }

    
    /**
     * @Route("/{id}", name="index_affichage_utilisateur", methods={"GET"})
     */
    public function showuser(Utilisateurs $utilisateurs, UtilisateursRepository $utilisateursRepository, Request $request, EntityManagerInterface $manager ): Response
    {
        return $this->render('utilisateurs/affichage_utilisateur.html.twig', [
            'id'=>$utilisateurs->getId(),
            'utilisateurs' => $utilisateurs,
        ]);
    }
}
