<?php
class Timesheet extends Db {
    public function getAllTimesheets() {
        return $this->getTable("Timesheet");
    }

    public function getTimesheetById($timesheetId) {
        $sql = "SELECT * FROM Timesheet WHERE TimesheetID = :timesheetId";
        $params = array(':timesheetId' => $timesheetId);
        return $this->selectQuery($sql, $params);
    }

    public function addTimesheet($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userId) {
        $sql = "INSERT INTO Timesheet (SDate, WorkedDay, AuthorizedAbsences, UnauthorizedAbsences, UserID) 
                VALUES (:sDate, :workedDay, :authorizedAbsences, :unauthorizedAbsences, :userId)";
        $params = array(
            ':sDate' => $sDate,
            ':workedDay' => $workedDay,
            ':authorizedAbsences' => $authorizedAbsences,
            ':unauthorizedAbsences' => $unauthorizedAbsences,
            ':userId' => $userId
        );
        return $this->updateQuery($sql, $params);
    }

    public function updateTimesheet($timesheetId, $sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userId) {
        $sql = "UPDATE Timesheet 
                SET SDate = :sDate, WorkedDay = :workedDay, AuthorizedAbsences = :authorizedAbsences, UnauthorizedAbsences = :unauthorizedAbsences, UserID = :userId
                WHERE TimesheetID = :timesheetId";
        $params = array(
            ':sDate' => $sDate,
            ':workedDay' => $workedDay,
            ':authorizedAbsences' => $authorizedAbsences,
            ':unauthorizedAbsences' => $unauthorizedAbsences,
            ':userId' => $userId,
            ':timesheetId' => $timesheetId
        );
        return $this->updateQuery($sql, $params);
    }

    public function deleteTimesheet($timesheetId) {
        $sql = "DELETE FROM Timesheet WHERE TimesheetID = :timesheetId";
        $params = array(':timesheetId' => $timesheetId);
        return $this->updateQuery($sql, $params);
    }

    public function getTimesheetsByUserId($userId) {
        $sql = "SELECT * FROM Timesheet WHERE UserID = :userId";
        $params = array(':userId' => $userId);
        return $this->selectQuery($sql, $params);
    }
}
?>
