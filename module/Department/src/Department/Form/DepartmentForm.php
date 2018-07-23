<?php
namespace Department\Form;

 use Zend\Form\Form;

 class DepartmentForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('department');

         $this->add(array(
             'name' => 'depid',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'depname',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Department Name',
             ),
         ));
         $this->add(array(
             'name' => 'submitd',
             'type' => 'button',
             'attributes' => array(
                 'value' => 'Go',
                 
             ),
         ));
     }
 }