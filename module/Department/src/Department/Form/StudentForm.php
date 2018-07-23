<?php
namespace Department\Form;

 use Zend\Form\Form;


 class StudentForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('student');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'sname',
             'type' => 'Text',
             'options' => array(
                 
             ),
         ));
         $this->add(array(
             'name' => 'semail',
             'type' => 'Text',
             'options' => array(
                 
             ),
         ));
         $this->add(array(
             'name' => 'sage',
             'type' => 'Text',
             'options' => array(
                 
             ),
         ));
         $this->add(array(
             'name' => 'sdepname',
             'type' => 'Text',
             'options' => array(
                 
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }