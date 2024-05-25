<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header('Location: login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    
    if ($newPassword !== $confirmNewPassword) {
        $errorMessage = "Mật khẩu mới và xác nhận mật khẩu mới không khớp nhau.";
    } else {
        $userID = $_SESSION['UserID']; // Lấy ID của người dùng từ session
        $currentPasswordFromDatabase = ""; // Lấy mật khẩu hiện tại của người dùng từ cơ sở dữ liệu
        
        // Thực hiện truy vấn để lấy mật khẩu hiện tại của người dùng từ cơ sở dữ liệu

        // So sánh mật khẩu cũ nhập vào với mật khẩu hiện tại của người dùng
        if (password_verify($currentPassword, $currentPasswordFromDatabase)) {
            // Mật khẩu cũ đúng, tiến hành cập nhật mật khẩu mới
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Mã hóa mật khẩu mới
            
            // Thực hiện truy vấn để cập nhật mật khẩu mới vào cơ sở dữ liệu
            
            // Hiển thị thông báo thành công và chuyển hướng về trang cá nhân
            $successMessage = "Đổi mật khẩu thành công.";
            header('Location: profile.php');
            exit();
        } else {
            // Mật khẩu cũ không đúng, hiển thị thông báo lỗi
            $errorMessage = "Mật khẩu cũ không chính xác.";
        }
    }
}
?>