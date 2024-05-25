<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $deptName = $_POST['deptName'];
    $location = $_POST['location'];

    include_once '../Controller/DepartmentController.php';

    $departmentController = new DepartmentController();

    $result = $departmentController->addDepartment($deptName, $location);

    if ($result) {
        $success_message = "Department has been added successfully";
        $redirect_url = "/admin/index.php?page=listDept";
    } else {
        $error_message = "Failed to add Department. Please try again!";
        $redirect_url = "/admin/index.php?page=addDept";
    }
} else {
    $error_message = "Yêu cầu không hợp lệ!";
    $redirect_url = "/admin/index.php?page=addDept";
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
