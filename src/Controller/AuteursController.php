<?php

namespace App\Controller;

use Faker;
use Faker\Factory;
use App\Entity\Auteurs;
use App\Form\AuteursType;
use App\Repository\AuteursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Role\Role;

class AuteursController extends AbstractController
{
       /**
     * @Route("/auteurs", name="index_auteurs")
     */
    public function auteursIndex(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Auteurs::class);
        $auteurs = $repo->findAll();
        return $this->render('auteurs/auteurs_index.html.twig', [
            'controller_name' => 'AuteursController',
            'auteurs' => $auteurs
        ]);
    }  

    /**
    * @Route("/auteurs_creation", name="index_auteurs_creation", methods={"GET","POST"})
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
        return $this->render('auteurs/auteurs_creation.html.twig', [
            'controller_name' => 'AuteursController',
            'auteurs' => $auteurs
        ]);
    }
    
        /**
     * @Route("auteurs_affichage/{id}", name="index_auteurs_affichage", methods={"GET"})
     */
    public function auteursInformations(Auteurs $auteur, AuteursRepository $auteursRepository, Request $request, EntityManagerInterface $manager): Response
    {
        return $this->render('auteurs/auteurs_affichage.html.twig', [
            'id' => $auteur->getId(),
            'articles'=> $auteur->getArticles(),
            'auteur' => $auteur,
        ]);
    }

       /**
     * @Route("/auteurs_formulaire", name="index_auteurs_formulaire", methods={"GET","POST"})
     */
    public function auteursFormulaire(Request $request): Response
    {
        $auteurs = new Auteurs();
        $form = $this->createForm(AuteursType::class, $auteurs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteurs);
            $entityManager->flush();
           return $this->redirectToRoute('index_auteurs_affichage', ['id' => $auteurs->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('auteurs/auteurs_formulaire.html.twig', [
            'auteurs' => $auteurs,
            'formAuteurs' => $form->createView(),
        ]);
    }   
   
      /**
     * @Route("/auteurs_modification/ {id})", name="index_auteurs_modification", methods={"GET","POST"})
     */

    public function auteursModification(Request $request , Auteurs $auteurs): Response
    {        
        $form = $this->createFormBuilder($auteurs)
        ->add('nom' , TextType::class, ['label' => 'Nom ' , 'required' => true])
        ->add('prenom' , TextType::class, ['label' => 'Prénom ', 'required' => true])
        ->add('email' , TextType::class, ['label' => 'Email ', 'required' => true]) 
        ->add('password', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ]) 
        ->add('roles' , ChoiceType::class, array(
            'choices'  => array('User' => 'ROLE_USER' , 'Editeur' => 'ROLE_EDITOR' , 'Admin' => 'ROLE_ADMIN'),  
            'multiple' => true,
            'expanded' => false))      
        ->add('Enregistrer' , SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteurs);
            $entityManager->flush();
           return $this->redirectToRoute('index_auteurs_affichage', ['id' => $auteurs->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->render('auteurs/auteurs_modification.html.twig', [           
            'auteursFormulaire' => $form->createView(),
        ]);
    }
   
}
