<?php 

namespace App\Controller;

use Twig\Environment;
use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


  class DepartmentController  extends AbstractController 
  {

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var ObjectManager
     */
    private $em ;

    public function __construct(DepartmentRepository $dptRepository, EntityManagerInterface $em)
    {
      $this->departmentRepository =  $dptRepository;
      $this->em = $em;
    }

     /**
     * @Route("/department/show", name="dept_show")
     * @return Response
     */
    public function show() : Response
      {
        
          return $this->render('/pages/department.html.twig',
             [
                'departements' =>$this->departmentRepository->findAll()
             ]
          );
      }


     /**
     *@Route("/department/delete/{id}", name="dept_delete", methods="DELETE", requirements={"id":"[0-9]*"})
     * @return Response
     */
    public function delete(Department $dept, Request $request) : Response
      {
         if ($this->isCsrfTokenValid('delete' . $dept->getId(), $request->get('_token'))){
             $this->em->remove($dept);
             $this->em->flush();
             $this->addFlash('success', 'Department a été bien supprimé!');
          return $this->redirectToRoute('dept_show');
         }
        
         return $this->redirectToRoute('dept_show');
      }

    /**
     * @Route("/departement/edit/{id}", name="dept_edit", methods="GET|POST|PUT", requirements={"id":"[0-9]*"})
     * @param Department $dept
     * @param Request $request
     * @return Response
     */
    public function edit(Department $dept, Request $request) : Response
    {
         $form =  $this->createForm(DepartmentType::class, $dept);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le Department a été bien edité!');
            return $this->redirectToRoute('dept_show');
         }
        return $this->render('/pages/editDepartement.html.twig',[
            'form' => $form->createView()
         ]
      
      );
    }

    
    /**
     * @Route("/department/new", name="dept_create", requirements={"id":"[0-9]*"})
     * 
     * @return Response
     */
    public function add(Request $request) : Response
    {
      $department =  new Department();
      $form =  $this->createForm(DepartmentType::class, $department);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $this->em->persist($department);
         $this->em->flush();
         $this->addFlash('success', 'Le Department a été bien ajouté!');
         return $this->redirectToRoute('dept_show');
      }
     return $this->render('/pages/addDepartement.html.twig',[
         'form' => $form->createView()
      ]
   
   );
    }

    /**
     * @Route("/department/{code}", name="dept_detail", requirements={"code":"[0-9]*"})
     * @return Response
     */
    public function showDetail($code ) : Response
      {
          $department = $this->departmentRepository->findById($code);
          return $this->render('/pages/departementDetail.html.twig',
             [
                'client' => $department
             ]
          );
      }
  }

?>