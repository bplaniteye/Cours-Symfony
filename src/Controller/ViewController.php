<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/view")
 */

class ViewController extends AbstractController
{
    /**
     * @Route("/", name="index_view")
     */
    public function view(): Response
    {
        return $this->render('view/view.html.twig', [
            'controller_name' => 'ViewController',
        ]);
    }

    /**
     * @Route("/identite", name="index_identite")
     */
    public function identite(): Response
    {
        $nom = "PLANITEYE";
        $prenom = "Ange";
        return $this->render('view/identite.html.twig', [
            'label_nom' => 'VOTRE NOM :',
            'label_prenom' => 'VOTRE PRENOM :',
            'nom' => $nom,
            'prenom' => $prenom,
        ]);
    }




    /**
     * @Route("/", name="index_view")
     */
    public function bonjour(): Response
    {
        $bjr = ["HELLO TOUT LE MONDE"];
        return $this->render('view/view.html.twig', $bjr);
    }
    // affiche le contenu d’un Eleement du tableau 
    // tableau[’idColonne’] }} affiche le contenu d’un el ´ ement du tableau 
    // est l’equivalent de ´ <?php echo $tableau[’idColonne’]; 
//http://127.0.0.1:8000/view/liste
    /**
     * @Route("/liste", name="index_liste")
     */
    public function tables(): Response
    {
        // J'initialise mon tableau   
        $tab = ["Ange PLANITEYE", "Bandiougou TRAORE", "Fabrice FOLLEREAU", "Matthieu THUET", "Moaaz KHASSAWNEH","Modou NDAO","Nabi MOHAMMED", 
         "Rudy LOPEZ","Valéry NWEHLA"];

        // J'appelle la vue TABLEAUX/TWIG
        return $this->render('view/liste.html.twig', [

            // J'affiche Mon tableau

            'cours_name' => 'COMPOSANTE VUE',
            'tableau' => $tab,
        ]);
    }


}
