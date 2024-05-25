<?php
include_once '../Controller/DepartmentController.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $deptId = $_GET['id'];
    
    $departmentController = new DepartmentController();
    
    $department = $departmentController->getDepartmentById($deptId);
    
    if($department) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $deptName = $_POST['deptName'];
            $location = $_POST['location'];

            $result = $departmentController->updateDepartment($deptId, $deptName, $location);

            if ($result) {
                $success_message = "Đã cập nhật thông tin phòng ban thành công";
                $redirect_url = "/admin/index.php?page=listDept";
            } else {
                $error_message = "Cập nhật thông tin phòng ban không thành công. Vui lòng thử lại sau.";
                $redirect_url = "/admin/index.php?page=listDept";
            }
        }
    } else {
        $error_message = "không tìm thấy phòng ban!";
        $redirect_url = "/admin/index.php?page=listDept";
    }
} else {
    // Nếu không có 'id' hoặc giá trị 'id' rỗng, chuyển hướng người dùng đến trang listDept.php
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