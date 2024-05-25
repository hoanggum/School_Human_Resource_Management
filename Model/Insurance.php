<?php

class Insurance extends Db {
    public function addInsurance($payDate, $grantBy, $userID) {
        $sql = "INSERT INTO insurance (PayDate, GrantBy, UserID) VALUES (:payDate, :grantBy, :userID)";
        $params = array(
            ':payDate' => $payDate,
            ':grantBy' => $grantBy,
            ':userID' => $userID
        );
        return $this->updateQuery($sql, $params);
    }

    public function deleteInsurance($insuranceID) {
        $sql = "DELETE FROM insurance WHERE InsuranceID = :insuranceID";
        $params = array(':insuranceID' => $insuranceID);
        return $this->updateQuery($sql, $params);
    }

    public function updateInsurance($insuranceID, $payDate, $grantBy, $userID) {
        $sql = "UPDATE insurance SET PayDate = :payDate, GrantBy = :grantBy, UserID = :userID WHERE InsuranceID = :insuranceID";
        $params = array(
            ':insuranceID' => $insuranceID,
            ':payDate' => $payDate,
            ':grantBy' => $grantBy,
            ':userID' => $userID
        );
        return $this->updateQuery($sql, $params);
    }

    public function getInsuranceById($insuranceID) {
        $sql = "SELECT * FROM insurance WHERE InsuranceID = :insuranceID";
        $params = array(':insuranceID' => $insuranceID);
        return $this->selectQuery($sql, $params);
    }
    public function getAllInsurances() {
        return $this->getTable('insurance');
    }
    public function getAllInsurancesOfEmployee() {
        $sql = "SELECT i.*, u.FullName 
                FROM insurance i 
                INNER JOIN users u ON i.UserID = u.UserID";
        return $this->selectQuery($sql);
    }
    
}
?>
