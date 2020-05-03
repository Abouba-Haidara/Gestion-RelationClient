<?php 

namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController  extends AbstractController
  {

    /**
     * @Route("/service/show", name="service_show")
     */
    public function show() : Response
      {
          return $this->render('/pages/service.html.twig');
      }

    /**
     * @Route("/service/add", name="service_create")
     */
    public function create() : Response
    {
        return $this->render('/pages/addService.html.twig');
    }

  }

?>