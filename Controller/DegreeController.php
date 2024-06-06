<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Degree.php';

class DegreeController {
    private $degreeModel;

    public function __construct() {
        $this->degreeModel = new Degree();
    }

    public function getAllDegrees() {
        return $this->degreeModel->getAllDegrees();
    }

    public function addDegree($degreeName, $grantedDate, $unit, $userID) {
        return $this->degreeModel->addDegree($degreeName, $grantedDate, $unit, $userID);
    }

    public function deleteDegree($degreeID) {
        return $this->degreeModel->deleteDegree($degreeID);
    }

    public function updateDegree($degreeID, $degreeName, $grantedDate, $unit, $userID) {
        return $this->degreeModel->updateDegree($degreeID, $degreeName, $grantedDate, $unit, $userID);
    }

    public function getDegreeById($degreeID) {
        return $this->degreeModel->getDegreeById($degreeID);
    }
    public function getAllDegreesWithFullName() {
        return $this->degreeModel->getAllDegreesWithFullName();
    }
    public function getDegreesByUserID($userID){
        return $this->degreeModel->getDegreesByUserID($userID);
    }
}
?>
