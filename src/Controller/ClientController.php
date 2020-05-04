<?php 

namespace App\Controller;

use Twig\Environment;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     *@Route("/client/delete/{id}", name="client_delete", methods="DELETE", requirements={"id":"[0-9]*"})
     * @return Response
     */
    public function delete(Client $client, Request $request) : Response
      {
         if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->get('_token'))){
             $this->em->remove($client);
             $this->em->flush();
             $this->addFlash('success', 'client a été bien supprimé!');
          return $this->redirectToRoute('client_show');
         }
        
         return $this->redirectToRoute('client_show');
      }

    /**
     * @Route("/client/edit/{id}", name="client_edit", methods="GET|POST|PUT", requirements={"id":"[0-9]*"})
     * @param Client $client
     * @return Response
     */


    public function edit(Client $client, Request $request) : Response
    {
         $form =  $this->createForm(ClientType::class, $client);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le client a été bien edité!');
            return $this->redirectToRoute('client_show');
         }
        return $this->render('/pages/editClient.html.twig',[
            'form' => $form->createView()
         ]
      
      );
    }

    
    /**
     * @Route("/client/new", name="client_create", requirements={"id":"[0-9]*"})
     * 
     * @return Response
     */
    public function add(Request $request) : Response
    {
      $client =  new Client();
      $form =  $this->createForm(ClientType::class, $client);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $this->em->persist($client);
         $this->em->flush();
         $this->addFlash('success', 'Le client a été bien ajouté!');
         return $this->redirectToRoute('client_show');
      }
     return $this->render('/pages/addClient.html.twig',[
         'form' => $form->createView()
      ]
   
   );
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