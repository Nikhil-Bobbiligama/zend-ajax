<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Department\Controller\Department' => 'Department\Controller\DepartmentController',
         ),
     ),
 'router' => array(
         'routes' => array(
             'department' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/department[/:refmodule][/:action][/:depid][/:newName][/:newAge][/:newEmail][/:newDepname][/:refdepid]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'depid'     => '[0-9]+',
                         'id'     => '[0-9]+',
                         
                     ),
                     'defaults' => array(
                         'controller' => 'Department\Controller\Department',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),


     'view_manager' => array(
         'template_path_stack' => array(
             'department' => __DIR__ . '/../view',
         ),
          'strategies'                => array(
        'ViewJsonStrategy',
    ),
     ),
 );