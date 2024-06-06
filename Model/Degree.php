<?php
class Degree extends Db {
    public function getAllDegrees() {
        return $this->getTable("degree");
    }

    public function addDegree($degreeName, $grantedDate, $unit, $userID) {
        $sql = "INSERT INTO degree (DegreeName, GrantedDate, Unit, UserID) VALUES (:degreeName, :grantedDate, :unit, :userID)";
        $params = array(':degreeName' => $degreeName, ':grantedDate' => $grantedDate, ':unit' => $unit, ':userID' => $userID);
        return $this->updateQuery($sql, $params);
    }

    public function deleteDegree($degreeID) {
        $sql = "DELETE FROM degree WHERE DegreeID = :degreeID";
        $params = array(':degreeID' => $degreeID);
        return $this->updateQuery($sql, $params);
    }

    public function updateDegree($degreeID, $degreeName, $grantedDate, $unit, $userID) {
        $sql = "UPDATE degree SET DegreeName = :degreeName, GrantedDate = :grantedDate, Unit = :unit, UserID = :userID WHERE DegreeID = :degreeID";
        $params = array(':degreeID' => $degreeID, ':degreeName' => $degreeName, ':grantedDate' => $grantedDate, ':unit' => $unit, ':userID' => $userID);
        return $this->updateQuery($sql, $params);
    }

    public function getDegreeById($degreeID) {
        $sql = "SELECT * FROM degree WHERE DegreeID = :degreeID";
        $params = array(':degreeID' => $degreeID);
        return $this->selectQuery($sql, $params);
    }
    public function getAllDegreesWithFullName() {
        $sql = "SELECT d.*, u.FullName 
                FROM degree d 
                INNER JOIN users u ON d.UserID = u.UserID";

        return $this->selectQuery($sql);
    }
    public function getDegreesByUserID($userID) {
        $sql = "SELECT * FROM degree WHERE UserID = :userID";
        $params = array(':userID' => $userID);
        return $this->selectQuery($sql, $params);
    }
}
?>
