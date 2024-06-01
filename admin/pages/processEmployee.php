<?php
include_once '../Controller/UserController.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; // Ensure this path is correct

$userController = new UserController();

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'novelnest977@gmail.com';
        $mail->Password = 'vbuv dzdj ksvh qovp'; // Use app-specific password or correct password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender info
        $mail->setFrom('novelnest977@gmail.com', 'Novelnest');

        // Recipient info
        $mail->addAddress($to);

        // Email subject & body
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_POST['submit'])) {
    // Collect form data
    $fullName = $_POST['fullName'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $departmentID = $_POST['deptID'];
    $positionID = $_POST['positionID'];
    $status = $_POST['status'];
    $password = substr($phone, -6);
    // Handle image upload
    if(isset($_FILES['img'])) {
        $imgName = $_FILES['img']['name'];
        $imgTmp = $_FILES['img']['tmp_name'];
        $imgPath = "../img/".$imgName;
        move_uploaded_file($imgTmp, $imgPath);
    } else {
        $imgName = "user.jpg"; // Default image if not provided
    }

    // Add employee
    $result = $userController->addEmployee($fullName, $birthday, $gender, $email, $address, $phone, $username, $positionID, $departmentID, $imgName, $status);

    if ($result) {
        $success_message = "Employee has been added successfully";
        $redirect_url = "/admin/index.php?page=listEmployee";

        // Send account information email
        $emailSubject = 'Your New Account Information';
        $emailBody = "
        <html>
        <head>
        <title>Your Account Information</title>
        </head>
        <body>
        <p>Dear $fullName,</p>
        <p>Your account has been created successfully. Here are your account details:</p>
        <table>
        <tr><th>Username</th><td>$username</td></tr>
        <tr><th>Email</th><td>$email</td></tr>
        <tr><th>Password</th><td>$password</td></tr>
        </table>
        <p>Best regards,<br>Novelnest</p>
        </body>
        </html>";

        $emailResult = sendEmail($email, $emailSubject, $emailBody);
        if (!$emailResult) {
            $error_message = "Failed to send account information email.";
        }
    } else {
        $error_message = "Failed to add Employee. Please try again.";
    }
}

echo "<script>";
if (isset($success_message)) {
    echo "alert('$success_message');";
}
if (isset($error_message)) {
    echo "alert('$error_message');";
}
if (isset($redirect_url)) {
    echo "window.location='$redirect_url';";
}
echo "</script>";
?>
