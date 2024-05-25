<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Insurance.php';

class InsuranceController {
    private $insuranceModel;

    public function __construct() {
        $this->insuranceModel = new Insurance();
    }

    public function getAllInsurances() {
        return $this->insuranceModel->getAllInsurances();
    }
    public function getAllInsurancesOfEmployees() {
        return $this->insuranceModel->getAllInsurancesOfEmployee();
    }

    public function addInsurance($payDate, $grantBy, $userID) {
        return $this->insuranceModel->addInsurance($payDate, $grantBy, $userID);
    }

    public function deleteInsurance($insuranceID) {
        return $this->insuranceModel->deleteInsurance($insuranceID);
    }

    public function updateInsurance($insuranceID, $payDate, $grantBy, $userID) {
        return $this->insuranceModel->updateInsurance($insuranceID, $payDate, $grantBy, $userID);
    }

    public function getInsuranceById($insuranceID) {
        return $this->insuranceModel->getInsuranceById($insuranceID);
    } 
}

?>
