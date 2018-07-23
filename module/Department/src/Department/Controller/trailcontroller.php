<?php
namespace Department\Controller;

use Department\Model\DepartmentTable;
use Department\Model\Student;
use Department\Model\StudentTable;
use Department\Model\Department;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JSONModel;

class DepartmentController extends AbstractActionController
{
  private $student;
  private $department;

  public function __construct(StudentTable $student, DepartmentTable $department)
  {
      $this->student = $student;
      $this->department = $department;
  }

  public function indexAction()
  {
    $depid = $_GET["depid"];
    $studentdetails= $this->students->fetchAll($depid);
    $request = $this->getRequest();
    if($request->isXmlHttpRequest())
    {
      $jsondata = [];
      $count=0;
      foreach ($studentdetails as $row) {
        $jsondata[$count]= array(
          'id' => $row->id,
          'sname' => $row->sname,
          'semail' => $row->semail,
          'sage' =>$row->sage,
          'sdepname' => $row->sdepname,
        );
        $count++;
      }
      // $finaldata = array(
      //   'jsondata' => $jsondata,
      //   'cid' => $cid
      // );
      $senddata = new JsonModel($jsondata);
      $senddata->setTerminal(true);
      return $senddata;
    }
    
  }

  public function addAction()
  {
    $cid = $this->params()->fromRoute('cid');
    $request = $this->getRequest();
    if (!$request->isXmlHttpRequest())
    {
      return ['cid' => $cid];
    }
    else {
      $id = 0;
      $sname = $_POST["sname"];
      $semail = $_POST["semail"];
      $class = $_POST["class_name"];
      $data = [
        'id' => $id,
        'sname' => $sname,
        'semail' => $semail,
        'class' => $class
      ];
      $student = new Students();
      $student->exchangeArray($data);
      $this->students->saveStudents($student);
    }
  }

  public function deleteAction()
  {
    $id = $_POST["id"];
    $this->students->deleteStudents($id);
  }

  public function editAction()
  {
    $request = $this->getRequest();
    if($request->isXmlHttpRequest())
    {
      $id = $_POST["sid"];
      $sname = $_POST["sname"];
      $semail = $_POST["semail"];
      $class = $_POST["cname"];
      $data = [
        'id' => $id,
        'sname' => $sname,
        'semail' => $semail,
        'class' => $class
      ];
      $student= new Students();
      $student->exchangeArray($data);
      $this->students->saveStudents($student);
    }
  }

  public function cindexAction()
  {
    $classdata = $this->classes->fetchAll();
    $jsondata = [];
    $count=0;
    foreach ($classdata as $data)
    {
      $jsondata[$count] = array(
        'cid' => $data->cid,
        'cname' => $data->cname
      );
      $count++;
    }
    $senddata = new JsonModel($jsondata);
    $senddata->setTerminal(true);
    return $senddata;
  }

  public function caddAction()
  {
    $request = $this->getRequest();
    if ($request->isXmlHttpRequest())
    {    
      $cname = $_POST["cname"];      
      $cid=0;
      $data = [
        'cid' => $cid,
        'cname' => $cname
      ];
      $class = new Classes();
      $class->exchangeArray($data);
      $this->classes->saveClasses($class);
      return $cname;
    }
    else {
      echo "in else statement";
    }
    

  }

  public function ceditAction()
  {
    $request = $this->getRequest();
    if($request->isXmlHttpRequest()) {
      $cid = $_POST["cid"];
      $cname = $_POST["cname"];
      $data = [
        'cid' => $cid,
        'cname' => $cname,
      ];
      $class = new Classes();
      $class->exchangeArray($data);
      $this->classes->saveClasses($class);
    }
    else
    {
      $cid = $this->params()->fromRoute('cid');
      $data=$this->classes->getClasses($cid);
      return ['data' => $data];
    }
  }
  public function cdeleteAction()
  {
    $cid = $_POST["cid"];
    $this->classes->deleteClasses($cid);
    $this->redirect()->toRoute('students');
  }

  public function scriptsAction()
  {
  }
 }
