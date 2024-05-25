<?php

class LeaveApplicationSheet extends Db {
    public function getAllLeaveApplicationSheets() {
        return $this->getTable("leaveapplicationsheet");
    }
    public function getLeaveApplicationSheetsOfAllUser() {
        $sql = "SELECT leaveapplicationsheet.*, users.*,img.*
                FROM leaveapplicationsheet
                JOIN users ON leaveapplicationsheet.UserID = users.UserID
                INNER JOIN img ON leaveapplicationsheet.UserID = img.UserID";
        return $this->selectQuery($sql);
    }

    public function addLeaveApplicationSheet($type, $startDate, $endDate, $reason, $userID) {
        $sql = "INSERT INTO leaveapplicationsheet (Type, StartDate, EndDate, Reason, UserID) VALUES (:type, :startDate, :endDate, :reason, :userID)";
        $params = array(
            ':type' => $type,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':reason' => $reason,
            ':userID' => $userID
        );
        return $this->updateQuery($sql, $params);
    }

    public function deleteLeaveApplicationSheet($LSheetID) {
        $sql = "DELETE FROM leaveapplicationsheet WHERE LSheetID = :LSheetID";
        $params = array(':LSheetID' => $LSheetID);
        return $this->updateQuery($sql, $params);
    }

    public function updateLeaveApplicationSheet($LSheetID, $type, $startDate, $endDate, $reason, $status, $userID) {
        $sql = "UPDATE leaveapplicationsheet SET Type = :type, StartDate = :startDate, EndDate = :endDate, Reason = :reason, Status = :status, UserID = :userID WHERE LSheetID = :LSheetID";
        $params = array(
            ':LSheetID' => $LSheetID,
            ':type' => $type,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':reason' => $reason,
            ':status' => $status,
            ':userID' => $userID
        );
        return $this->updateQuery($sql, $params);
    }
    public function confirmLeaveApplicationSheet($LSheetID, $status) {
        $sql = "UPDATE leaveapplicationsheet SET LStatus = :status WHERE LSheetID = :LSheetID";
        $params = array(
            ':LSheetID' => $LSheetID,
            ':status' => $status,
        );
        return $this->updateQuery($sql, $params);
    }

    public function getLeaveApplicationSheetById($LSheetID) {
        $sql = "SELECT leaveapplicationsheet.*, users.*, img.*
                FROM leaveapplicationsheet
                JOIN users ON leaveapplicationsheet.UserID = users.UserID
                INNER JOIN img ON leaveapplicationsheet.UserID = img.UserID
                WHERE LSheetID = :LSheetID";
        $params = array(':LSheetID' => $LSheetID);
        return $this->selectQuery($sql, $params);
    }

    public function getAllLeaveApplicationSheetsOfUser($userID) {
        $sql = "SELECT * FROM leaveapplicationsheet WHERE UserID = :userID";
        $params = array(':userID' => $userID);
        return $this->selectQuery($sql, $params);
    }
    public function getFilteredLeaveApplicationSheets($status = 'All', $sort = 'ASC', $search = '', $page = 1, $items_per_page = 10) {
        // Initialize $offset to 0
        $offset = 0;
    
        // Calculate $offset only if $page is numeric
        if (is_numeric($page)) {
            $offset = ($page - 1) * $items_per_page;
        } else {
            // Handle non-numeric $page gracefully (optional)
            // For example, you can set $page to 1 or throw an exception
            // Here, we'll set $page to 1
            $page = 1;
        }
    
        // Build SQL query
        $sql = "SELECT leaveapplicationsheet.*, users.*, img.*
                FROM leaveapplicationsheet
                JOIN users ON leaveapplicationsheet.UserID = users.UserID
                INNER JOIN img ON leaveapplicationsheet.UserID = img.UserID
                WHERE 1=1";
        
        // Add conditions based on status and search
        if ($status !== 'All') {
            $sql .= " AND leaveapplicationsheet.LStatus = :status";
        }
        
        if (!empty($search)) {
            $sql .= " AND (users.FullName LIKE :search OR leaveapplicationsheet.Reason LIKE :search)";
        }
    
        // Add sorting and pagination
        $sql .= " ORDER BY leaveapplicationsheet.LSheetID $sort LIMIT $offset, $items_per_page";
        
        // Prepare parameters
        $params = array();
        
        if ($status !== 'All') {
            $params[':status'] = $status;
        }
    
        if (!empty($search)) {
            $params[':search'] = '%' . $search . '%';
        }
        
        // Execute query
        return $this->selectQuery($sql, $params);
    }
    
    
}
