<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Role.php';

class RoleController {
    private $roleModel;
    
        
    public function __construct() {
        $this->roleModel = new Role();
    }
    public function getAllRoles() {
        return $this->roleModel->getAllRoles();
    }
}
?>