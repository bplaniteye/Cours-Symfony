<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/view", name="my_view")     
*/


 class MyViewController extends AbstractController
{
    /**
     * @Route("/my_view", name="index_my_view")
     */
    public function index(): Response
    {
        return $this->render('my_view/index.html.twig', [
            'cours_name' => ' COMPOSANTE VUE',
        ]);
    }



    // affiche le contenu d’un Eleement du tableau 
    // tableau[’idColonne’] }} affiche le contenu d’un el ´ ement du tableau 
    // est l’equivalent de ´ <?php echo $tableau[’idColonne’]; 

    /**
     * @Route("/tableau", name="view_tab")
     */
    public function tables(): Response
    {
        // J'initialise mon tableau   
        $tab = ["Ange","Bandiougou","Fabrice","Matthieu","Moaaz","Modou","Nabi","Rudy", "Valéry"];

        // J'appelle la vue TABLEAUX/TWIG
        return $this->render('view/liste.html.twig', [
        
        // J'affiche Mon tableau
    
        'cours_name' => 'COMPOSANTE VUE',
        'tableau' => $tab,
        ]);
        }
}