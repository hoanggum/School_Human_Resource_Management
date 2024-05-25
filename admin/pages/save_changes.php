<?php


include_once '../Controller/UserController.php';

$userController = new UserController();
$userID = $_SESSION['UserID'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full-name'];
    $userName = $_POST['user-name'];
    $userEmail = $_POST['user-email'];
    $userPhoneNumber = $_POST['user-phonenumber'];
    $userAddress = $_POST['user-address'];

    $result = $userController->updateUserInfo($userID, $fullName, $userName, $userEmail, $userPhoneNumber, $userAddress);

    if ($result) {
        $success_message = "Cập nhật thông tin người dùng thành công";
        $redirect_url = "/admin/index.php?page=profile";
    } else {
        $error_message = "Cập nhật thông tin người dùng thất bại";
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
