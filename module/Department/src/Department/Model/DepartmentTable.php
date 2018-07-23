<?php
namespace Department\Model;

 use Zend\Db\TableGateway\TableGateway;

 class DepartmentTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getDepartment($depid)
     {
         $depid  = (int) $depid;
         $rowset = $this->tableGateway->select(array('depid' => $depid));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $depid");
         }
         return $row;
     }

     public function saveDepartment(Department $department)
     {
         $data = array(
             'depname' => $department->depname,
             
         );

         $depid = (int) $department->depid;
         if ($depid == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getDepartment($depid)) {
                 $this->tableGateway->update($data, array('depid' => $depid));
             } else {
                 throw new \Exception('Department id does not exist');
             }
         }
     }

     public function deleteDepartment($depid)
     {
         $this->tableGateway->delete(array('depid' => (int) $depid));
     }
 }
