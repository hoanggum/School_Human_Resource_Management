<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Salary.php';

class SalaryController {
    private $salaryModel;

    public function __construct() {
        $this->salaryModel = new Salary();
    }

    public function getAllSalaries() {
        return $this->salaryModel->getAllSalaries();
    }
    public function getAllSalariesAndTimesheet() {
        return $this->salaryModel->getAllSalaryAndTimesheet();
    }

    public function getSalaryById($salaryId) {
        return $this->salaryModel->getSalaryById($salaryId);
    }
    public function addSalaryAndTimesheets($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userID, $basic, $allowance, $advance, $total){
        return $this->salaryModel->addSalaryAndTimesheet($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userID, $basic, $allowance, $advance, $total);
    }
    public function addSalary($basic, $allowance, $advance, $total, $sDate, $payday, $status, $userId) {
        return $this->salaryModel->addSalary($basic, $allowance, $advance, $total, $sDate, $payday, $status, $userId);
    }

    public function updateSalary($salaryId, $basic, $allowance, $advance, $total, $sDate, $payday, $status, $userId) {
        return $this->salaryModel->updateSalary($salaryId, $basic, $allowance, $advance, $total, $sDate, $payday, $status, $userId);
    }

    public function deleteSalary($salaryId) {
        return $this->salaryModel->deleteSalary($salaryId);
    }
    public function getSalaryOfPeople($userID,$year) {
        return $this->salaryModel->getSalaryOfPeople($userID,$year);
    }
    public function getAllSalaryOfEmp() {
        return $this->salaryModel->getAllSalaryOfEmp();
    }
    public function addSalaryAndTimesheets2($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userID, $basic, $allowance, $advance, $total){
        return $this->salaryModel->addSalaryAndTimesheet2($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userID, $basic, $allowance, $advance, $total);
    }
}
?>
