<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("location")
 */

class LocationController extends AbstractController
{
    /**
     * @Route("/location_form1", name="index_location_form1" , methods={"GET", "POST"})
     */
    // Ici on Fait une Enregistrement avec une Formulaire

    public function locationForm1(Request $request, EntityManagerInterface $manager)
    {
        $location = new Location(); // Instanciation

        // Creation de mon Formulaire
        $form = $this->createFormBuilder($location)
        ->add('date')
        ->add('titre')
        ->add('categorie')
        ->add('image')
        ->add('description')
        ->add('adresse')
        ->add('valeur')
        ->add('adresse')
        ->add('accessibility') 
        ->add('status') 
        ->add('a_la_une')

            // Demande le résultat
            ->getForm();

        // Analyse des Requetes & Traitement des information 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($location);
            $manager->flush();

            return $this->redirectToRoute(
                'index_affichage_location',
                ['id' => $location->getId()]
            ); // Redirection vers la page
        }

        // Redirection du Formulaire vers le TWIG pour l’affichage avec
        return $this->render('location/location_form1.html.twig', [
            'formLocation' => $form->createView()
        ]);
    }

    /**
     * @Route("/location_form2", name="index_location_form2", methods={"GET","POST"})
     */
    public function locationForm2(Request $request): Response
    {
        $location = new Location();
        $form = $this->createForm(locationType::class, $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($location);
            $entityManager->flush();

            return $this->redirectToRoute('index_location', ['id' => $location -> getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('location/location_form2.html.twig', [
            'location' => $location,
            'formLocation' => $form->createView(),
        ]);
    }


    /**
     * @Route("/", name="index_locations")
     */

    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Location::class);
        $location = $repo->findAll();

        return $this->render('location/index_locations.html.twig', [
            'controller_name' => 'locationController',
            'location' => $location,
        ]);
    }


    /**
     * @Route("/nouvelle_location", name="index_nouvelle_location", methods={"GET", "POST"})
     */
    public function nouveau(Request $request, EntityManagerInterface $em): Response
    {
        $location = new location();
        // Ici je fais un enregistrement Manuel, on verra la suite avec le  Formulaire
        $location->setDate(new  \DateTime());
        $location->setTitre(" Titre de mon Article");
        $location->setCategorie(" photo de mon Article");
        $location->setImage(" Titre de mon Article");      
        $location->setDescription(" Contenu de mon Article Contenu de mon ArticleContenu de mon ArticleContenu de mon ArticleContenu de mon Article");
        $location->setValeur(" Titre de mon Article");
        $location->setAdresse(" photo de mon Article");
        $location->setAccessibility(" Titre de mon Article");
        $location->setStatus(" Titre de mon Article");
        $location->setALaUne(" Titre de mon Article");
        // Je persiste Mon Enregistrement
        $em->persist($location);
        $em->flush();
        // J'envoie au niveau du temple pour l'enregistrement
        return $this->render('location/nouvelle_location.html.twig', [
            'location' => $location,
        ]);
    }


    /**
     * @Route("/{id}", name="index_affichage_location", methods={"GET"})
     */
    public function show(Location $location, LocationRepository $locationRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('location/affichage_location.html.twig', [
            'id' => $location->getId(),
            'location' => $location,
        ]);
    }
}
