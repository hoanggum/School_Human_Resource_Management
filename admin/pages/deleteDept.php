<?php
include_once '../Controller/DepartmentController.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $deptId = $_GET['id'];

    $departmentController = new DepartmentController();

    $result = $departmentController->deleteDepartment($deptId);

    if ($result) {
        $success_message = "Đã xóa phòng ban thành công";
        $redirect_url = "/admin/index.php?page=listDept";
    } else {
        $error_message = "Xóa phòng ban không thành công. Vui lòng thử lại sau.";
        $redirect_url = "/admin/index.php?page=listDept";
    }
} else {
    $error_message = "ID phòng ban không hợp lệ!";
    $redirect_url = "/admin/index.php?page=listDept";
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
