<?php
// Include the UserController class
include_once '../Controller/UserController.php';

// Create an instance of the UserController
$userController = new UserController();

// Kiểm tra xem dữ liệu đã được gửi từ form chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem selectedUser đã được gửi chưa
    if (isset($_POST['selectedUser'])) {
        // Lấy ID của người dùng được chọn
        $selectedUserID = $_POST['selectedUser'];
        
        // Cập nhật vai trò của người dùng thành Admin
        $result = $userController->updateUserRole($selectedUserID, 'Admin');
        if ($result) {
            $success_message = "Role has been Update successfully";
            $redirect_url = "/admin/index.php?page=role";
        } else {
            $error_message = "Failed to update Role. Please try again!";
            $redirect_url = "/admin/index.php?page=role";
        }
    } else {
        // Xử lý lỗi nếu không có dữ liệu người dùng được gửi
        $error_message = "Không tìm thấy dữ liệu người dùng được chọn.";
        $redirect_url = "/admin/index.php?page=role";
    }
} else {
    // Xử lý lỗi nếu trang không được gọi bằng phương thức POST
    $error_message = "Trang này chỉ có thể được truy cập thông qua phương thức POST.";
    $redirect_url = "/admin/index.php?page=role";
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
    exit();
?>
