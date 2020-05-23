<?php

namespace App\Controller;

use App\Events;
use App\Entity\User;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecuriteController  extends AbstractController
{

    /**
     * @Route("/TestEvent", name="sec_login")
     */
    public function login(EventDispatcherInterface $eventDispatcher): Response
    {

        //On déclenche l'event
        $event = new GenericEvent(new User());
        $eventDispatcher->dispatch(Events::USER_REGISTERED, $event);
        return $this->render('/pages/sec/login.html.twig');
    }
}