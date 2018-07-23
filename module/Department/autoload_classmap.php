 <?php
 return array(
 'controllers' => array(
         'invokables' => array(
             'Department\Controller\Department' => 'Department\Controller\DepartmentController',
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'department' => __DIR__ . '/../view',
         ),
     ),
     );