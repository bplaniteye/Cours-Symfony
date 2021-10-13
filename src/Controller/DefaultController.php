<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="index_default")
     */
    public function default(): Response
    {
        return $this->render('default/default.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/bonjour", name="index_bonjour")
     */
    public function bonjour()
    {
        return new Response("BONJOUR TOUT LE MONDE !");
    }

    /**
     * @Route("/salut/{id}", name="index_salut")
     */
    public function salut($id)
    {
        return new Response("Salut à toi .$id.!");
    }

    // REPONSE & VUE
    // http://127.0.0.1:8001/affichage/leo
    /**
     * @Route("/affichage/{id}", name="index_affichage")
     */
    public function affichage($id)
    {
      // On utilise le raccourci : il crée un objet Response
      // Et lui donne comme contenu le contenu du template
      return $this->render('default/affichage.html.twig', array(
        'id' => $id,
      ));
    }

      // REDIRECTION
      // http://127.0.0.1:8001/redirect/id
    // return $this->redirectToRoute('homepage');
    /**
     * @Route("/redirect/{id}", name="index_redir")
     */
    public function redirecto($id)
    {
        return $this->redirectToRoute('home');
    }

}
