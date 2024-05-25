<?php

class Position extends Db {
    public function getAllPositions() {
        return $this->getTable("position");
    }

    public function addPosition($positionName) {
        $sql = "INSERT INTO position (PositionName) VALUES (:positionName)";
        $params = array(
            ':positionName' => $positionName
        );
        return $this->updateQuery($sql, $params);
    }

    public function deletePosition($positionID) {
        $sql = "DELETE FROM position WHERE PositionID = :positionID";
        $params = array(':positionID' => $positionID);
        return $this->updateQuery($sql, $params);
    }

    public function updatePosition($positionID, $positionName) {
        $sql = "UPDATE position SET PositionName = :positionName WHERE PositionID = :positionID";
        $params = array(
            ':positionID' => $positionID,
            ':positionName' => $positionName
        );
        return $this->updateQuery($sql, $params);
    }

    public function getPositionById($positionID) {
        $sql = "SELECT * FROM position WHERE PositionID = :positionID";
        $params = array(':positionID' => $positionID);
        return $this->selectQuery($sql, $params);
    }
}

?>
