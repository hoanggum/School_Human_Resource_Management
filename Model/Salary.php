<?php
class Salary extends Db {
    public function getAllSalaries() {
        return $this->getTable("Salary");
    }

    public function getSalaryById($salaryId) {
        $sql = "SELECT * FROM Salary WHERE SalaryID = :salaryId";
        $params = array(':salaryId' => $salaryId);
        return $this->selectQuery($sql, $params);
    }
    public function getAllSalaryOfEmp() {
        $sql = "SELECT s.*, u.FullName
                FROM salary s
                INNER JOIN users u ON s.UserID = u.UserID
                INNER JOIN Img i ON s.UserID = i.UserID
                GROUP BY s.UserID,s.SalaryID, u.FullName, i.Url";
        return $this->selectQuery($sql);
    }
    public function getAllSalaryAndTimesheet() {
        $sql = "SELECT s.*, t.WorkedDay, t.AuthorizedAbsences,t.UnauthorizedAbsences, u.FullName, i.Url
                FROM Salary s
                INNER JOIN timesheet t ON s.SheetID = t.SheetID
                INNER JOIN users u ON s.UserID = u.UserID
                INNER JOIN Img i ON s.UserID = i.UserID
                GROUP BY u.UserID,s.SalaryID, u.FullName, i.Url";
        return $this->selectQuery($sql);
    }

    public function addSalary($basic, $allowance, $advance, $total, $sDate, $payday, $status, $userId) {
        $sql = "INSERT INTO Salary (Basic, Allowance, Advance, Total, SDate, Payday, Status, UserID) 
                VALUES (:basic, :allowance, :advance, :total, :sDate, :payday, :status, :userId)";
        $params = array(
            ':basic' => $basic,
            ':allowance' => $allowance,
            ':advance' => $advance,
            ':total' => $total,
            ':sDate' => $sDate,
            ':payday' => $payday,
            ':status' => $status,
            ':userId' => $userId
        );
        return $this->updateQuery($sql, $params);
    }

    public function updateSalary($salaryId, $basic, $allowance, $advance, $total, $sDate, $payday, $status, $userId) {
        $sql = "UPDATE Salary 
                SET Basic = :basic, Allowance = :allowance, Advance = :advance, Total = :total, SDate = :sDate, Payday = :payday, Status = :status, UserID = :userId
                WHERE SalaryID = :salaryId";
        $params = array(
            ':basic' => $basic,
            ':allowance' => $allowance,
            ':advance' => $advance,
            ':total' => $total,
            ':sDate' => $sDate,
            ':payday' => $payday,
            ':status' => $status,
            ':userId' => $userId,
            ':salaryId' => $salaryId
        );
        return $this->updateQuery($sql, $params);
    }

    public function deleteSalary($salaryId) {
        $sql = "DELETE FROM Salary WHERE SalaryID = :salaryId";
        $params = array(':salaryId' => $salaryId);
        return $this->updateQuery($sql, $params);
    }
    public function addSalaryAndTimesheet($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsence, $userID, $basic, $allowance, $advance, $total) {
        $sql = "CALL InsertTimesheetAndSalary(:sDate, :workedDay, :authorizedAbsences, :unauthorizedAbsence, :userID, :basic, :allowance, :advance, :total)";
        $params = array(
            ':sDate' => $sDate,
            ':workedDay' => $workedDay,
            ':authorizedAbsences' => $authorizedAbsences,
            ':unauthorizedAbsence' => $unauthorizedAbsence,
            ':userID' => $userID,
            ':basic' => $basic,
            ':allowance' => $allowance,
            ':advance' => $advance,
            ':total' => $total
        );
        return $this->updateQuery($sql, $params);
    }
    public function getSalaryOfPeople($userID, $year) {
        $sql = "SELECT s.*, t.WorkedDay, t.AuthorizedAbsences,t.UnauthorizedAbsences, u.FullName
                FROM salary s
                INNER JOIN timesheet t ON s.SheetID = t.SheetID
                INNER JOIN users u ON s.UserID = u.UserID
                WHERE s.UserID = :userID AND YEAR(s.SDate) = :year
                GROUP BY s.UserID, s.SalaryID, u.FullName
                ORDER BY MONTH(s.SDate) ASC;";
        
        $params = array(':userID' => $userID, ':year' => $year);
    
        return $this->selectQuery($sql, $params);
    }
    public function addSalaryAndTimesheet2($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsence, $userID, $basic, $allowance, $advance, $total) {
        try {
            // Begin the transaction
            $this->beginTransaction();

            // Insert into Timesheet
            $timesheetSql = "INSERT INTO Timesheet (SDate, WorkedDay, AuthorizedAbsences, UnauthorizedAbsences, UserID)
                             VALUES (:sDate, :workedDay, :authorizedAbsences, :unauthorizedAbsence, :userID)";
            $timesheetParams = array(
                ':sDate' => $sDate,
                ':workedDay' => $workedDay,
                ':authorizedAbsences' => $authorizedAbsences,
                ':unauthorizedAbsence' => $unauthorizedAbsence,
                ':userID' => $userID
            );
            $this->updateQuery($timesheetSql, $timesheetParams);

            // Get the last inserted ID for Timesheet
            $lastSheetID = $this->lastInsertId();

            // Insert into Salary
            $salarySql = "INSERT INTO Salary (SheetID, Basic, Allowance, Advance, Total, SDate, UserID)
                          VALUES (:sheetID, :basic, :allowance, :advance, :total, :sDate, :userID)";
            $salaryParams = array(
                ':sheetID' => $lastSheetID,
                ':basic' => $basic,
                ':allowance' => $allowance,
                ':advance' => $advance,
                ':total' => $total,
                ':sDate' => $sDate,
                ':userID' => $userID
            );
            $this->updateQuery($salarySql, $salaryParams);

            // Commit the transaction
            $this->commit();

            return true;
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->rollBack();
            return false;
        }
    }

  
    
}
?>
