<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/about", name="index_about")
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
/**
 * @Route("/contact",name="index_contact")
 */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

/**
 * @Route("/programme",name="index_programme")
 */
    public function programme(): Response
    {
        return $this->render('home/programme.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
 * @Route("/galerie",name="index_galerie")
 */
public function galerie(): Response
{
    return $this->render('home/galerie.html.twig', [
        'controller_name' => 'HomeController',
    ]);
}

/**
 * @Route("/actualites",name="index_actualites")
 */
public function actualites(): Response
{
    return $this->render('home/actualites.html.twig', [
        'controller_name' => 'HomeController',
    ]);
}





}
