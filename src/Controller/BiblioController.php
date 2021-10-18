<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BiblioController extends AbstractController
{
    /**
     * @Route("biblio", name="index_biblio")
     */
    public function index(): Response
    {
        return $this->render('biblio/index.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

    /**
     * @Route("a_propos", name="index_a_propos")
     */
    public function a_propos(): Response
    {
        return $this->render('biblio/a_propos.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

    /**
     * @Route("livres", name="index_livres")
     */
    public function livres(): Response
    {
        return $this->render('biblio/livres.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

    /**
     * @Route("locations", name="index_locations")
     */
    public function locations(): Response
    {
        return $this->render('biblio/locations.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("documentation", name="index_documentation")
     */
    public function documentation(): Response
    {
        return $this->render('biblio/documentation.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("contact", name="index_contactbiblio")
     */
    public function contact(): Response
    {
        return $this->render('biblio/contact.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("connexion", name="index_connexion")
     */
    public function connexion(): Response
    {
        return $this->render('biblio/connexion.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("administration", name="index_administration")
     */
    public function administration(): Response
    {
        return $this->render('biblio/administration.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

    // CONTROLLER ADMIN

      /**
     * @Route("utilisateurs", name="index_utilisateurs")
     */
    public function utilisateurs(): Response
    {
        return $this->render('biblio/utilisateurs.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("systeme", name="index_systeme")
     */
    public function systeme(): Response
    {
        return $this->render('biblio/systeme.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("contenu", name="index_contenu")
     */
    public function contenu(): Response
    {
        return $this->render('biblio/contenu.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("images", name="index_images")
     */
    public function images(): Response
    {
        return $this->render('biblio/images.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("categorie", name="index_categorie")
     */
    public function categorie(): Response
    {
        return $this->render('biblio/categorie.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("articles-a-la-une", name="index_articles-a-la-une")
     */
    public function articlesALaUne(): Response
    {
        return $this->render('biblio/articles-a-la-une.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("extensions", name="index_extensions")
     */
    public function extensions(): Response
    {
        return $this->render('biblio/extensions.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }

      /**
     * @Route("logout", name="index_logout")
     */
    public function logout(): Response
    {
        return $this->render('biblio/logout.html.twig', [
            'controller_name' => 'BiblioController',
        ]);
    }






















}
