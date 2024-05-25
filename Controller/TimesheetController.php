<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Timesheet.php';

class TimesheetController {
    private $timesheetModel;

    public function __construct() {
        $this->timesheetModel = new Timesheet();
    }

    public function getAllTimesheets() {
        return $this->timesheetModel->getAllTimesheets();
    }

    public function getTimesheetById($timesheetId) {
        return $this->timesheetModel->getTimesheetById($timesheetId);
    }

    public function addTimesheet($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userId) {
        return $this->timesheetModel->addTimesheet($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userId);
    }

    public function updateTimesheet($timesheetId, $sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userId) {
        return $this->timesheetModel->updateTimesheet($timesheetId, $sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsences, $userId);
    }

    public function deleteTimesheet($timesheetId) {
        return $this->timesheetModel->deleteTimesheet($timesheetId);
    }

    public function getTimesheetsByUserId($userId) {
        return $this->timesheetModel->getTimesheetsByUserId($userId);
    }
}
?>
