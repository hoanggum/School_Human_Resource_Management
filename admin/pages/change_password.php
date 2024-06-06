<?php
include_once '../Controller/UserController.php';
$userController = new UserController();

if (!isset($_SESSION['UserID'])) {
    header('Location: login.html');
    exit();
}

if (isset($_POST['submitPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    
    if ($newPassword !== $confirmNewPassword) {
        $error_message = "Mật khẩu mới và xác nhận mật khẩu mới không khớp nhau.";
    } else {
        $userID = $_SESSION['UserID']; // Lấy ID của người dùng từ session
        $user = $userController->getPasswordById($userID);
        $currentPasswordFromDatabase = $user[0]['Password'];
        
        // Lấy mật khẩu hiện tại của người dùng từ cơ sở dữ liệu
        if (md5($currentPassword) == $currentPasswordFromDatabase) {
            $result = $userController->updatePassword($userID, $newPassword);

            if ($result) {
                // Cập nhật mật khẩu thành công
                $success_message = "Đổi mật khẩu thành công.";
                $redirect_url = "?page=profile";
                $confirm_logout = true; // Kích hoạt hộp thoại xác nhận đăng xuất
            } else {
                // Cập nhật mật khẩu không thành công
                $error_message = "Đã xảy ra lỗi khi cập nhật mật khẩu.";
            }
        } else {
            // Mật khẩu cũ không đúng, hiển thị thông báo lỗi
            $error_message = "Mật khẩu cũ không chính xác.";
        }
    }
}
echo "<script>";
if (isset($success_message)) {
    echo "alert('$success_message');";
}
if (isset($error_message)) {
    echo "alert('$error_message');";
}
// Kiểm tra nếu có yêu cầu đăng xuất và hộp thoại xác nhận được kích hoạt
if (isset($_POST['logout']) && isset($confirm_logout)) {
    echo "if (confirm('Bạn có chắc chắn muốn đăng xuất không?')) { window.location='logout.php'; }";
} else {
    echo "window.location='$redirect_url';";
}
echo "</script>";
exit();
?>
