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
    public function registration(Request $request, EventDispatcherInterface $eventDispatcher): Response
    {
        $user =  new User();
        $form =  $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Le client a été bien ajouté!');
            //On déclenche l'event
            $event = new GenericEvent($user);
            $eventDispatcher->dispatch(Events::USER_REGISTERED, $event);
            $this->addFlash('success', 'un message vous a  été envoyé.');
            return $this->redirectToRoute('sec_registration');
        }

        return $this->render('/pages/sec/register.html.twig');
    }
}