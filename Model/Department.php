<?php
class Department extends Db{
    public function getAllDepartments() {
        return $this->getTable("department");
    }
    public function countDepartments() {
        $sql = "SELECT COUNT(*) AS department_count FROM department";
        
        return $this->selectQuery($sql);
    }
    
    public function addDepartment($deptName, $location) {
        $sql = "INSERT INTO department (DeptName, Location) VALUES (:deptName, :location)";
        $params = array(':deptName' => $deptName, ':location' => $location);
        return $this->updateQuery($sql, $params);
    }

    public function deleteDepartment($deptId) {
        $sql = "DELETE FROM department WHERE DeptID = :deptId";
        $params = array(':deptId' => $deptId);
        return $this->updateQuery($sql, $params);
    }
    public function updateDepartment($deptId, $deptName, $location) {
        $sql = "UPDATE department SET DeptName = :deptName, Location = :location WHERE DeptID = :deptId";
        $params = array(':deptId' => $deptId, ':deptName' => $deptName, ':location' => $location);
        return $this->updateQuery($sql, $params);
    }
    public function getDepartmentById($deptId) {
        $sql = "SELECT * FROM department WHERE DeptID = :deptId";
        $params = array(':deptId' => $deptId);
        return $this->selectQuery($sql, $params);
    }
     
    
    
}