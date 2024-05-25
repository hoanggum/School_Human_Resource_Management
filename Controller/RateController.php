<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Rate.php';
class RateController {
    private $rateModel;
    public function getRatesByMonthAndYear($classified, $month, $year) {
        return $this->rateModel->getRatesByMonthAndYear($classified, $month, $year);
    }
        
    public function __construct() {
        $this->rateModel = new Rate();
    }
    public function getAllRates() {
        return $this->rateModel->getAllRates();
    }
    public function counttRate($classified) {
        return $this->rateModel-> counttRate($classified);
    }
    public function getRateById($rateId) {
        return $this->rateModel->getRateById($rateId);
    }
    public function getRateByMonth($type) {
        return $this->rateModel->getRateByMonth($type);
    }
    public function addRate($classified, $rDate, $reason, $userId) {
        return $this->rateModel->addRate($classified, $rDate, $reason, $userId);
    }
    public function getLastInsertedId()
    {
        return $this->rateModel->getLastInsertedId();
    }

    public function updateRate($rateId, $classified, $rDate, $reason, $userId) {
        return $this->rateModel->updateRate($rateId, $classified, $rDate, $reason, $userId);
    }

    public function deleteRate($rateId) {
        return $this->rateModel->deleteRate($rateId);
    }

    public function getRatesByClassified($classified) {
        return $this->rateModel->getRate($classified);
    }
}
?>