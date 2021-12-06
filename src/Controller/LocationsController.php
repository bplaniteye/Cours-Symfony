<?php

namespace App\Controller;

use Faker;
use App\Entity\Locations;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationsController extends AbstractController
{
    /**
     * @Route("locations", name="index_locations")
     */

    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Locations::class);
        $locations = $repo->findAll();
        return $this->render('locations/locations_index.html.twig', [
            'page' => 'Locations',
            'locations' => $locations,

        ]);
    }

    /**
     * @Route("/locations_creation", name="index_locations_creation", methods={"GET", "POST"})
     */
    public function nouveau(Request $request, EntityManagerInterface $em): Response
    {
        $faker = Faker\Factory::create('fr_FR');
        $stat = ['Actif', 'Occupé', 'Désactivé'];
        shuffle($stat);
        //$bool = [true, false];
        //shuffle($bool);
        for ($i = 0; $i < 100; $i++) {
            $location = new Locations();            
            $location->setDate(new  \DateTime());
            $location->setTitre($faker->sentence());
            //$location->setCategorie(" photo de mon Article");
            $location->setImage($faker->imageUrl());
            $location->setDescription($faker->text());
            $location->setValeur(mt_rand(0.5, 100));
            $location->setAdresse($faker->address());
           // $location->setAccessibilite($bool[0]);
            $location->setAccessibilite($faker->boolean(2));
            $location->setStatut($stat[0]);
            //$location->setUne($bool[0]);
            $location->setUne($faker->boolean(2));         
            $em->persist($location);
        }
        $em->flush();
        // J'envoie au niveau du temple pour l'enregistrement
        return $this->render('locations/locations_creation.html.twig', [
            'locations' => $location,
        ]);
    }
}
