<?php
include_once '../config.php';
include_once '../Library/Db.class.php';
include_once '../Model/Schedule.php';

class ScheduleController {
    private $scheduleModel;

    public function __construct() {
        $this->scheduleModel = new Schedule();
    }

    public function getAllSchedules() {
        return $this->scheduleModel->getAllSchedules();
    }
    public function getScheduleOfUser() {
        return $this->scheduleModel->getScheduleOfUser();
    }
    public function addSchedule($startDate, $endDate, $workPlace, $descriptions, $userId) {
        return $this->scheduleModel->addSchedule($startDate, $endDate, $workPlace, $descriptions, $userId);
    }
    public function getScheduleByMonth($month, $year) {
        return $this->scheduleModel->getScheduleByMonth($month, $year);
    }
    public function deleteSchedule($scheduleId) {
        return $this->scheduleModel->deleteSchedule($scheduleId);
    }

    public function updateSchedule($scheduleId, $startDate, $endDate, $workPlace, $descriptions, $userId) {
        return $this->scheduleModel->updateSchedule($scheduleId, $startDate, $endDate, $workPlace, $descriptions, $userId);
    }

    public function getScheduleById($scheduleId) {
        return $this->scheduleModel->getScheduleById($scheduleId);
    }
    public function getScheduleOfOUser($userId) {
        return $this->scheduleModel->getScheduleOfOUser($userId);
    }
    public function getScheduleOfMonth($userID, $month, $year) {
        return $this->scheduleModel->getScheduleOfMonth($userID,$month,$year);
    }
}
?>
