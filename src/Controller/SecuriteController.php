<?php

namespace App\Controller;

use App\Events;
use App\Entity\User;
use Twig\Environment;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecuriteController  extends AbstractController
{

    /**
     * @Route("/login", name="sec_login")
     */
    public function login(): Response
    {
        return $this->render('/pages/sec/login.html.twig');
    }
    /**
     * @Route("/registration", name="sec_registration")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $passwordEncoder, EventDispatcherInterface $eventDispatcher): Response
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //On déclenche l'event
            $event = new GenericEvent($user);
            $eventDispatcher->dispatch(Events::USER_REGISTERED, $event);
            // Set a "flash" success message for the user
            $this->addFlash('success', 'un message vous a  été envoyé.');
            return $this->redirectToRoute('sec_registration');
        }

        return $this->render('/pages/sec/register.html.twig');
    }
}