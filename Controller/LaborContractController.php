<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/LaborContract.php';

class LaborContractController {
    private $laborContractModel;

    public function __construct() {
        $this->laborContractModel = new LaborContract();
    }

    public function getAllLaborContracts() {
        return $this->laborContractModel->getAllLaborContracts();
    }

    public function addLaborContract($laborID, $startDate, $endDate, $status) {
        return $this->laborContractModel->addLaborContract($laborID, $startDate, $endDate, $status);
    }

    public function deleteLaborContract($contractID) {
        return $this->laborContractModel->deleteLaborContract($contractID);
    }

    public function updateLaborContract($contractID, $laborID, $startDate, $endDate, $status) {
        return $this->laborContractModel->updateLaborContract($contractID, $laborID, $startDate, $endDate, $status);
    }

    public function getLaborContractById($contractID) {
        return $this->laborContractModel->getLaborContractById($contractID);
    }

    public function getAllLaborContractOfUser() {
        return $this->laborContractModel->getAllLaborContractOfUser();
    }
}

?>
