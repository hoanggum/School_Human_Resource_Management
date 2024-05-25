<?php

include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/LeaveApplicationSheet.php';

class LeaveApplicationSheetController {
    private $leaveApplicationSheetModel;

    public function __construct() {
        $this->leaveApplicationSheetModel = new LeaveApplicationSheet();
    }

    public function getAllLeaveApplicationSheets() {
        return $this->leaveApplicationSheetModel->getAllLeaveApplicationSheets();
    }
    public function getLeaveApplicationSheetsOfAllUser() {
        return $this->leaveApplicationSheetModel->getLeaveApplicationSheetsOfAllUser();
    }
    public function addLeaveApplicationSheet($type, $startDate, $endDate, $reason, $userID) {
        return $this->leaveApplicationSheetModel->addLeaveApplicationSheet($type, $startDate, $endDate, $reason, $userID);
    }

    public function deleteLeaveApplicationSheet($LSheetID) {
        return $this->leaveApplicationSheetModel->deleteLeaveApplicationSheet($LSheetID);
    }

    public function updateLeaveApplicationSheet($LSheetID, $type, $startDate, $endDate, $reason, $status, $userID) {
        return $this->leaveApplicationSheetModel->updateLeaveApplicationSheet($LSheetID, $type, $startDate, $endDate, $reason, $status, $userID);
    }

    public function confirmLeaveApplicationSheet($LSheetID, $lstatus) {
        return $this->leaveApplicationSheetModel->confirmLeaveApplicationSheet($LSheetID, $lstatus);
    }

    public function getLeaveApplicationSheetById($LSheetID) {
        return $this->leaveApplicationSheetModel->getLeaveApplicationSheetById($LSheetID);
    }

    public function getAllLeaveApplicationSheetsOfUser($userID) {
        return $this->leaveApplicationSheetModel->getAllLeaveApplicationSheetsOfUser($userID);
    }
    public function getFilteredLeaveApplicationSheets($status = 'All', $sort = 'ASC', $search = '', $page = 1, $items_per_page = 10) {
        return $this->leaveApplicationSheetModel->getFilteredLeaveApplicationSheets($status, $sort, $search, $page, $items_per_page);
    }
    public function getTotalLeaveApplicationSheets($status = 'All', $search = '') {
        return count($this->leaveApplicationSheetModel->getFilteredLeaveApplicationSheets($status, 'ASC', $search, 1, PHP_INT_MAX));
    }
}

?>
