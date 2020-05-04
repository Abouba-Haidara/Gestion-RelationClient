<?php 

namespace App\Controller\admin;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  class AdminController  extends AbstractController
  {

    /**
     * @Route("/employe/show", name="employe_show")
     */
      public function show() : Response
      {
          return $this->render('/pages/employe.html.twig');
      }

      /**
     * @Route("/employe/create", name="employe_create")
     */
      public function create() : Response
      {
          return $this->render('/pages/admin.html.twig');
      }

  }

?>