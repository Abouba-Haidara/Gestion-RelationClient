<?php 

namespace App\Controller\admin;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  class AdminController  extends AbstractController
  {

    /**
     * @Route("/admin/show", name="admin_show")
     */
      public function show() : Response
      {
          return $this->render('/pages/employe.html.twig');
      }

      /**
     * @Route("/admin/create", name="admin_create")
     */
      public function create() : Response
      {
          return $this->render('/pages/admin.html.twig');
      }

  }

?>