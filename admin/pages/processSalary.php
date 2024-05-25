<?php
    include_once '../Controller/SalaryController.php';
    $salaryController = new SalaryController();
    if(isset($_POST['submit'])){
        // Lấy dữ liệu từ form
        $userID = $_POST['employee'];
        $date = $_POST['date'];
        $basic = $_POST['basic'];
        echo $basic;
        $workedDay = $_POST['workedDay'];
        $authorizedAbsences = $_POST['authorizedAbsences'];
        $unauthorizedAbsence = $_POST['unauthorizedAbsence'];
        $allowance = $_POST['allowance'];
        $advance = $_POST['advance'];
        $total = $_POST['total'];

        $result = $salaryController->addSalaryAndTimesheets2($date, $workedDay, $authorizedAbsences, $unauthorizedAbsence, $userID, $basic, $allowance, $advance, $total);
        if ($result) {
            $success_message = "Salary has been added successfully";
            $redirect_url = "/admin/index.php?page=listSalary";
        } else {
            $error_message = "Failed to add Salary. Please try again.";
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