<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }
    public function countUser(){
        return $this->userModel->countUser();
    }
    public function getAllEmployee(){
        return $this->userModel->getAllEmployees();
    }
    public function getAllUser(){
        return $this->userModel->getAllUsers();
    }
    public function getUserById($UserID){
        return $this->userModel->getUserById($UserID);
    }
    public function getEmployeesByDeptId($deptId) {
        return $this->userModel->getEmployeesByDeptId($deptId);
    }
    public function addEmployee($fullName, $gender, $email, $address, $phone, $username, $password, $positionID,$departmentID, $imgURL,$status) {
        return $this->userModel->addEmployee($fullName, $gender, $email, $address, $phone, $username, $password,$positionID,$departmentID, $imgURL,$status);
    }
    public function updateUserInfo($userID, $fullName, $userName, $userEmail, $userPhoneNumber, $userAddress) {
        return $this->userModel->updateUserInfo($userID, $fullName, $userName, $userEmail, $userPhoneNumber, $userAddress);
    }
    public function updatePassword($userID, $newPassword) {
        return $this->userModel->updatePassword($userID, $newPassword);
    }
    public function getUserDetailsById($userId) {
        return $this->userModel->getUserDetailsById($userId);
    }
    public function updateEmployee($userId, $fullName, $birthday, $gender, $email, $address, $phone, $positionID, $departmentID, $imgPath, $status) {
        return $this->userModel->updateEmployee($userId, $fullName, $birthday, $gender, $email, $address, $phone, $positionID, $departmentID, $imgPath, $status);
    }
}
?>
