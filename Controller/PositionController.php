<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Position.php';

class PositionController {
    private $positionModel;

    public function __construct() {
        $this->positionModel = new Position();
    }

    public function getAllPositions() {
        return $this->positionModel->getAllPositions();
    }

    public function addPosition($positionName) {
        return $this->positionModel->addPosition($positionName);
    }

    public function deletePosition($positionID) {
        return $this->positionModel->deletePosition($positionID);
    }

    public function updatePosition($positionID, $positionName) {
        return $this->positionModel->updatePosition($positionID, $positionName);
    }

    public function getPositionById($positionID) {
        return $this->positionModel->getPositionById($positionID);
    }
}

?>
