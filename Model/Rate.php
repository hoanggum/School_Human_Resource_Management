<?php

class Rate extends Db {
    public function getAllRates() {
        return $this->getTable("Rate");
    }

    public function getRateById($rateId) {
        $sql = "SELECT r.*, u.* 
                FROM rate r 
                INNER JOIN users u ON r.UserID = u.UserID 
                WHERE RateID = :rateId";
        $params = array(':rateId' => $rateId);
        return $this->selectQuery($sql, $params);
    }
    public function counttRate($classified) {
        $sql = "SELECT COUNT(*) AS NumberRate
                FROM rate r
                WHERE r.Classifiled = :classified";
        $params = array(':classified' => $classified);
        return $this->selectQuery($sql, $params);
    }
    public function addRate($Classifiled, $rDate, $reason, $userId) {
        $sql = "INSERT INTO rate (Classifiled, RDate, Reason, UserID) VALUES (:Classifiled, :rDate, :reason, :userId)";
        $params = array(
            ':Classifiled' => $Classifiled,
            ':rDate' => $rDate,
            ':reason' => $reason,
            ':userId' => $userId
        );
        return $this->updateQuery($sql, $params);
    }

    public function updateRate($rateId, $classified, $rDate, $reason, $userId) {
        $sql = "UPDATE Rate SET Classified = :classified, RDate = :rDate, Reason = :reason, UserID = :userId WHERE RateID = :rateId";
        $params = array(
            ':rateId' => $rateId,
            ':Classifiled' => $classified,
            ':rDate' => $rDate,
            ':reason' => $reason,
            ':userId' => $userId
        );
        return $this->updateQuery($sql, $params);
    }
    public function getLastInsertedId()
    {
        return $this->lastInsertId();
    }

    public function deleteRate($rateId) {
        $sql = "DELETE FROM Rate WHERE RateID = :rateId";
        $params = array(':rateId' => $rateId);
        return $this->updateQuery($sql, $params);
    }
    public function getRate($classified) {
        $sql = "SELECT r.*, u.FullName, i.Url
                FROM rate r
                INNER JOIN users u ON r.UserID = u.UserID
                INNER JOIN img i ON u.UserID = i.UserID
                WHERE r.Classifiled = :classified";
        $params = array(':classified' => $classified);
        return $this->selectQuery($sql, $params);
    }
    public function getRatesByMonthAndYear($Classifiled, $month, $year) {
        // Xử lý tháng và năm thành chuỗi ngày tháng
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));
    
        $sql = "SELECT r.*, u.FullName 
                FROM rate r 
                INNER JOIN users u ON r.UserID = u.UserID 
                WHERE r.Classifiled = :Classifiled 
                AND r.RDate BETWEEN :startDate AND :endDate";
    
        // Bind các tham số và thực hiện truy vấn
        $params = array(':Classifiled' => $Classifiled, ':startDate' => $startDate, ':endDate' => $endDate);
        return $this->selectQuery($sql, $params);
    }
    public function getRateByMonth($type) {
        $sql = "SELECT MONTH(RDate) AS Month, COUNT(*) AS Count
                FROM rate
                WHERE Classifiled = :type
                GROUP BY MONTH(RDate)";
        
        $params = array(':type' => $type);
        
        return $this->selectQuery($sql, $params);
    }
       
    
}

?>
