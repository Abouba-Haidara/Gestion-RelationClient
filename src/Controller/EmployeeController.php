<?php 

namespace App\Controller;

use Twig\Environment;
use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


  class EmployeeController  extends AbstractController 
  {

    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    /**
     * @var ObjectManager
     */
    private $em ;

    public function __construct(EmployeeRepository $employeeRepository, EntityManagerInterface $em)
    {
      $this->employeeRepository =  $employeeRepository;
      $this->em = $em;
    }

     /**
     * @Route("/employee/show", name="employe_show")
     * @return Response
     */
    public function show() : Response
      {
        
          return $this->render('/pages/employee.html.twig',
             [
                'employees' =>$this->employeeRepository->findAll()
             ]
          );
      }


     /**
     *@Route("/employee/delete/{id}", name="employe_delete", methods="DELETE", requirements={"id":"[0-9]*"})
     * @return Response
     */
    public function delete(Employee $employee, Request $request) : Response
      {
         if ($this->isCsrfTokenValid('delete' . $employee->getId(), $request->get('_token'))){
             $this->em->remove($employee);
             $this->em->flush();
             $this->addFlash('success', 'Employee a été bien supprimé!');
          return $this->redirectToRoute('employee_show');
         }
        
         return $this->redirectToRoute('employee_show');
      }

    /**
     * @Route("/employee/edit/{id}", name="employe_edit", methods="GET|POST|PUT", requirements={"id":"[0-9]*"})
     * @param Employee $employee
     * @param Request $request
     * @return Response
     */
    public function edit(Employee $employee, Request $request) : Response
    {
         $form =  $this->createForm(EmployeeType::class, $employee);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Le Employee a été bien edité!');
            return $this->redirectToRoute('employee_show');
         }
        return $this->render('/pages/editEmployee.html.twig',[
            'form' => $form->createView()
         ]
      
      );
    }

    
    /**
     * @Route("/employee/new", name="employe_create", requirements={"id":"[0-9]*"})
     * 
     * @return Response
     */
    public function add(Request $request) : Response
    {
      $employee =  new Employee();
      $form =  $this->createForm(EmployeeType::class, $employee);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $this->em->persist($employee);
         $this->em->flush();
         $this->addFlash('success', 'Le Employee a été bien ajouté!');
         return $this->redirectToRoute('employe_show');
      }
     return $this->render('/pages/addEmployee.html.twig',[
         'form' => $form->createView()
      ]
   
   );
    }

    /**
     * @Route("/Employee/{code}", name="employe_detail", requirements={"code":"[0-9]*"})
     * @return Response
     */
    public function showDetail($code ) : Response
      {
          $employee = $this->employeeRepository->findById($code);
          return $this->render('/pages/employeeDetail.html.twig',
             [
                'client' => $employee
             ]
          );
      }
  }
