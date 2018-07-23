<?php
namespace Department\Controller;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Department\Model\Department;          // <-- Add this import
 use Department\Form\DepartmentForm; 
 use Department\Form\DepartmentTable; 
 use Department\Form\StudentTable; 
 use Department\Model\Student;          // <-- Add this import
 use Department\Form\StudentForm; 
 use Zend\View\Model\JSONModel;
 class DepartmentController extends AbstractActionController
 {private $student;
  private $department;
    public function getStudentTable()
     {
         if (!$this->studentTable) {
             $sm = $this->getServiceLocator();
             $this->studentTable = $sm->get('Department\Model\StudentTable');
         }
         return $this->studentTable;
     }
   public function indexAction()
  {  
    $departmentdata = $this->getDepartmentTable()->fetchAll();
         $studentdata = $this->getStudentTable()->fetchAll();

    $request = $this->getRequest();

 $refmodule= $this->params()->fromRoute('refmodule');
    if($request->isXmlHttpRequest()){
      if($refmodule=='department')
      {
    $jsondata = [];
    $count=0;
    foreach ($departmentdata as $data)
    {
      $jsondata[$count] = array(
        'depid' => $data->depid,
        'depname' => $data->depname
      );
      $count++;
    }
    $senddata = new JsonModel($jsondata);
    return ($senddata);
    }
    if($refmodule=='student')
    {

    
    $jsondata = [];
    $count=0;
    foreach ($studentdata as $data)
    {
      $jsondata[$count] = array(
        'id' => $data->id,
        'sname' => $data->sname,
        'semail'=> $data->semail,
        'sage'=>$data->sage,
        'sdepname'=>$data->sdepname,
        'sdepid'=>$data->sdepid
      );
      $count++;
    }
    $senddata = new JsonModel($jsondata);
    return ($senddata);
    

    }
    }
  }
  public function addAction()
  {
    $request = $this->getRequest();
    $id = 0;
 $refmodule= $this->params()->fromRoute('refmodule');
    if (!$request->isXmlHttpRequest())
    {
      
    }
    else {
      if($refmodule=='department')
      {
 $sname= $this->params()->fromRoute('newName');
      $data = [
         'depid' => $id,
        'depname' => $sname];
      $department = new Department();
      $department->exchangeArray($data);
                 $this->getDepartmentTable()->saveDepartment($department);
             $senddata = new JsonModel($data);
    return ($senddata); 
  }
if($refmodule=='student')
{
$refmodule= $this->params()->fromRoute('refmodule');
 
 $sname= $this->params()->fromRoute('newName');
      $semail= $this->params()->fromRoute('newEmail');
      $sage= $this->params()->fromRoute('newAge');
      $sdepname= $this->params()->fromRoute('newDepname');
      $sdepid= $this->params()->fromRoute('refdepid');
      $data = [
         'id' => $id,
        'sname' => $sname,
        'semail' => $semail,
        'sage' =>$sage,
        'sdepname' => $sdepname,
        'sdepid'=>$sdepid
        ];
      $student = new Student();
      $student->exchangeArray($data);
                 $this->getStudentTable()->saveStudent($student);
             $senddata = new JsonModel($data);
    return ($refmodule); 
  
}

}}
 public function editAction()
  {
    $request = $this->getRequest();
     $refmodule= $this->params()->fromRoute('refmodule');
    
    if (!$request->isXmlHttpRequest())
    {
      
    }
    else {
      if($refmodule=='department')
      {
      $id=$this->params()->fromRoute('depid');
 $sname= $this->params()->fromRoute('newName');
      $data = [
         'depid' => $id,
        'depname' => $sname];
      $department = new Department();
      $department->exchangeArray($data);
                 $this->getDepartmentTable()->saveDepartment($department);
             $senddata = new JsonModel($data);
    return ($senddata); 
 }
  if($refmodule=='student')
  {
    $id=$this->params()->fromRoute('depid');
 $sname= $this->params()->fromRoute('newName');
      $semail= $this->params()->fromRoute('newEmail');
      $sage= $this->params()->fromRoute('newAge');
      $sdepname= $this->params()->fromRoute('newDepname');
      $sdepid= $this->params()->fromRoute('refdepid');
      $data = [
         'id' => $id,
        'sname' => $sname,
        'semail' => $semail,
        'sage' =>$sage,
        'sdepname' => $sdepname,
        'sdepid'=>$sdepid
        ];
      $student = new Student();
      $student->exchangeArray($data);
                 $this->getStudentTable()->saveStudent($student);
             $senddata = new JsonModel($data);
    return ($senddata); 
  

  }
  }}
  
  public function deleteAction()
  {
    $request = $this->getRequest();
    $refmodule= $this->params()->fromRoute('refmodule');
    
    if (!$request->isXmlHttpRequest())
    {

    }
    else
    {  if($refmodule=='department')
    {  
     $id=$this->params()->fromRoute('depid');
      $this->getDepartmentTable()->deleteDepartment($id);
    }
     if($refmodule=='student')
     {
      $id=$this->params()->fromRoute('depid');
      $this->getStudentTable()->deleteStudent($id);
       
     }
  }
  }


      public function getDepartmentTable()
     {
         if (!$this->departmentTable) {
             $sm = $this->getServiceLocator();
             $this->departmentTable = $sm->get('Department\Model\DepartmentTable');
         }
         return $this->departmentTable;
     }
    protected $departmentTable; 
    protected $studentTable;
 }