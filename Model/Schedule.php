<?php


class Schedule extends Db {
    public function getAllSchedules() {
        return $this->getTable("schedule");
    }

    public function addSchedule($startDate, $endDate, $workPlace, $descriptions, $userId) {
        $sql = "INSERT INTO schedule (StartDate, EndDate, WorkPlace, Descriptions, UserID) VALUES (:startDate, :endDate, :workPlace, :descriptions, :userId)";
        $params = array(
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':workPlace' => $workPlace,
            ':descriptions' => $descriptions,
            ':userId' => $userId
        );
        return $this->updateQuery($sql, $params);
    }

    public function deleteSchedule($scheduleId) {
        $sql = "DELETE FROM schedule WHERE ScheduleID = :scheduleId";
        $params = array(':scheduleId' => $scheduleId);
        return $this->updateQuery($sql, $params);
    }

    public function updateSchedule($scheduleId, $startDate, $endDate, $workPlace, $descriptions, $userId) {
        $sql = "UPDATE schedule SET StartDate = :startDate, EndDate = :endDate, WorkPlace = :workPlace, Descriptions = :descriptions, UserID = :userId WHERE ScheduleID = :scheduleId";
        $params = array(
            ':scheduleId' => $scheduleId,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':workPlace' => $workPlace,
            ':descriptions' => $descriptions,
            ':userId' => $userId
        );
        return $this->updateQuery($sql, $params);
    }

    // Phương thức để lấy thông tin của một lịch trình dựa trên ID
    public function getScheduleById($scheduleId) {
        $sql = "SELECT * FROM schedule WHERE ScheduleID = :scheduleId";
        $params = array(':scheduleId' => $scheduleId);
        return $this->selectQuery($sql, $params);
    }
    public function getScheduleOfUser() {
        $sql = "SELECT s.*, u.FullName AS FullName 
                FROM schedule s 
                INNER JOIN users u ON s.UserID = u.UserID"; 
        return $this->selectQuery($sql);
    }
    public function getScheduleByMonth($month, $year) {
        $sql = "SELECT schedule.*, users.FullName 
                FROM schedule 
                INNER JOIN users ON schedule.UserID = users.UserID 
                WHERE (MONTH(schedule.StartDate) <= :month AND YEAR(schedule.StartDate) = :year) AND (MONTH(schedule.EndDate) >= :month AND YEAR(schedule.EndDate) = :year)";
        
        $params = array(
            ':month' => $month,
            ':year' => $year
        );
    
        return $this->selectQuery($sql, $params);
    }
    public function getScheduleOfOUser($userId) {
        $sql = "SELECT * FROM schedule WHERE UserID = :userId";
        $params = array(':userId' => $userId);
        return $this->selectQuery($sql, $params);
    }
    public function getScheduleOfMonth($userID, $month, $year) {
        $sql = "SELECT * FROM schedule WHERE UserID = :userID AND YEAR(StartDate) = :year AND MONTH(StartDate) = :month ORDER BY StartDate ASC";
        $params = array(
            ':userID' => $userID,
            ':month' => $month,
            ':year' => $year
        );
        return $this->selectQuery($sql, $params);
    }
    
    
}
?>
