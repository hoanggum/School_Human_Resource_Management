<?php

class LaborContract extends Db {
    public function getAllLaborContracts() {
        return $this->getTable("laborcontract");
    }

    public function addLaborContract($laborID, $startDate, $endDate, $status) {
        $sql = "INSERT INTO laborcontract (LaborID, StartDate, EndDate, Status) VALUES (:laborID, :startDate, :endDate, :status)";
        $params = array(
            ':laborID' => $laborID,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':status' => $status
        );
        return $this->updateQuery($sql, $params);
    }

    public function deleteLaborContract($contractID) {
        $sql = "DELETE FROM laborcontract WHERE ContractID = :contractID";
        $params = array(':contractID' => $contractID);
        return $this->updateQuery($sql, $params);
    }

    public function updateLaborContract($contractID, $laborID, $startDate, $endDate, $status) {
        $sql = "UPDATE laborcontract SET LaborID = :laborID, StartDate = :startDate, EndDate = :endDate, Status = :status WHERE ContractID = :contractID";
        $params = array(
            ':contractID' => $contractID,
            ':laborID' => $laborID,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':status' => $status
        );
        return $this->updateQuery($sql, $params);
    }

    public function getLaborContractById($contractID) {
        $sql = "SELECT * FROM laborcontract WHERE ContractID = :contractID";
        $params = array(':contractID' => $contractID);
        return $this->selectQuery($sql, $params);
    }

    public function getAllLaborContractOfUser() {
        $sql = "SELECT lc.*, u.FullName 
                FROM laborcontract lc 
                INNER JOIN users u ON lc.UserID = u.UserID";
        return $this->selectQuery($sql);
    }
    
}
?>
