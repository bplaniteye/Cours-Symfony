<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Form\AuteursType;
use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('index_utilisateurs');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

     /**
     * @Route("/auteurs_inscription", name="index_auteurs_inscription")
     */
    public function AuteursInscription(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager): Response
    {
        $auteurs = new Auteurs;
        $form = $this->createForm(AuteursType::class, $auteurs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $auteurs->setPassword(
            $userPasswordEncoder->encodePassword(
                    $auteurs,
                    $form->get('password')->getData()
                )
            );
            $entityManager->persist($auteurs);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('index_utilisateurs');
        }
        return $this->render('auteurs/auteurs_inscription.html.twig', [
            'auteursFormulaire' => $form->createView(),
        ]);
    }
}
