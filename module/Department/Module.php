<?php
 namespace Department;
 use Department\Model\Department;
 use Department\Model\DepartmentTable;
 use Department\Model\Student;
 use Department\Model\StudentTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
      public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Department\Model\DepartmentTable' =>  function($sm) {
                     $tableGateway = $sm->get('DepartmentTableGateway');
                     $table = new DepartmentTable($tableGateway);
                     return $table;
                 },
                 'DepartmentTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Department());
                     return new TableGateway('department', $dbAdapter, null, $resultSetPrototype);
                 },
                 'Department\Model\StudentTable' =>  function($sm) {
                     $tableGateway = $sm->get('StudentTableGateway');
                     $table = new StudentTable($tableGateway);
                     return $table;
                 },
                 'StudentTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Student());
                     return new TableGateway('student', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 