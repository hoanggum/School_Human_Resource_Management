<?php
    include_once '../Controller/ScheduleController.php';

    $scheduleController = new ScheduleController();

    if(isset($_POST['submit'])){
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $workPlace = $_POST['workPlace'];
        $descriptions = $_POST['descriptions'];
        $userId = $_POST['userID'];

        $result = $scheduleController->addSchedule($startDate, $endDate, $workPlace, $descriptions, $userId);
        
        if ($result) {
            $success_message = "Schedule has been added successfully.";
            $redirect_url = "/admin/index.php?page=listSchedule";

        } else {
            $error_message = "Failed to add schedule. Please try again.";
            $redirect_url = "/path/to/error/createSchedule"; 
        }
    }

    echo "<script>";
    if (isset($success_message)) {
        echo "alert('$success_message');";
    }
    if (isset($error_message)) {
        echo "alert('$error_message');";
    }
    echo "window.location='$redirect_url';";
    echo "</script>";
?>
