<?php

namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}