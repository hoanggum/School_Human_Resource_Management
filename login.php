<?php

session_start();
include_once "connect.php"; // Kết nối tới cơ sở dữ liệu

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

    // Xác thực thông tin người dùng từ cơ sở dữ liệu
    $sql = "SELECT * FROM users WHERE Username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user) {
        if(md5($password) === $user['Password']) {
            $_SESSION['UserID'] = $user['UserID'];
            $_SESSION['FullName'] = $user['FullName'];
            $_SESSION['Role'] = $user['Role'];
            if($remember == "on") {
                // Thiết lập cookie để lưu tên người dùng và mật khẩu
                setcookie("username", $username, time() + (86400 * 30), "/"); // 30 ngày
                setcookie("password", $password, time() + (86400 * 30), "/"); // 30 ngày
            }
            if($user['Role'] == "Admin") {
                $success_message = "Đăng nhập thành công chào ".$user['FullName'];
                echo "<script>alert('$success_message');</script>";
                header('Location: ./admin/index.php');
                exit();
            } else {
                header('Location: ./user/index.php');
                exit();
            }
        } else {
            $error_message = "Mật khẩu không chính xác.";
            echo "<script>alert('$error_message');</script>";
            header('Location: index.html');

        }
    } else {
        $error_message = "Tên đăng nhập không tồn tại.";
        echo "<script>alert('$error_message');</script>";
        header('Location: index.html');

    }
}
?>
