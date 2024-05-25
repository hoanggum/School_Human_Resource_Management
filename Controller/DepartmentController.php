<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Department.php';

class DepartmentController {
    private $departmentModel;

    public function __construct() {
        $this->departmentModel = new Department();
    }
    
    public function index() {
        return $this->departmentModel->getAllDepartments();
    }
    public function countDepartments() {
        return $this->departmentModel->countDepartments();
    }
    public function addDepartment($deptName, $location) {
        return $this->departmentModel->addDepartment($deptName, $location);
    }
    public function deleteDepartment($deptId) {
        return $this->departmentModel->deleteDepartment($deptId);
    }
    public function updateDepartment($deptId, $deptName, $location) {
        return $this->departmentModel->updateDepartment($deptId, $deptName, $location);
    }
    public function getDepartmentById($deptId) {
        return $this->departmentModel->getDepartmentById($deptId);
    }
}
?>
