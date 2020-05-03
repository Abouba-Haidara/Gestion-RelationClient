<?php 

namespace App\Controller;

use Twig\Environment;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


  class ClientController  extends AbstractController 
  {

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ObjectManager
     */
    private $em ;

    public function __construct(ClientRepository $clRepository, EntityManagerInterface $em)
    {
      $this->clientRepository =  $clRepository;
      $this->em = $em;
    }

     /**
     * @Route("/client/show", name="client_show")
     * @return Response
     */
    public function show() : Response
      {
        
          return $this->render('/pages/client.html.twig',
             [
                'clients' =>$this->clientRepository->findAll()
             ]
          );
      }
     /**
     * @Route("/client/delte", name="client_delete")
     * @return Response
     */
    public function delete() : Response
      {
        
          return $this->render('/pages/client.html.twig',
             [
                'clients' =>$this->clientRepository->findAll()
             ]
          );
      }

    /**
     * @Route("/client/add", name="client_create")
     * @return Response
     */
    public function create() : Response
    {
      $client =  new Client();
           $client =  new Client();
           $client->setLastName("Abouba")->setName("Haidara")->setEmail("abouba@gmail.com")->setPhone("777540819");
           $em = $this->getDoctrine()->getManager();
           $this->em->persist($client);
           $this->em->flush();
        return $this->render('/pages/addClient.html.twig');
    }

    /**
     * @Route("/client/{code}", name="client_detail", requirements={"code":"[0-9]*"})
     * @return Response
     */
    public function showDetail($code ) : Response
      {
          $client = $this->clientRepository->findById($code);
          return $this->render('/pages/clientDetail.html.twig',
             [
                'client' => $client
             ]
          );
      }
  }

?>