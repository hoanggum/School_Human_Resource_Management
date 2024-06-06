<?php
// Include necessary files
include_once "connect.php"; // Assuming this file contains your database connection code
require './vendor/autoload.php'; // Assuming this is where your PHPMailer library is located

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to send email using PHPMailer
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

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get email from form
    $email = $_POST['email'];

    // Query to check if user exists with the provided email
    $sql = "SELECT * FROM users WHERE Email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user exists
    if ($user) {
        // Generate a random token for password reset
        $token = bin2hex(random_bytes(50)); // Generate random token
        // Insert or update the token in the database
        $sql = "INSERT INTO password_resets (email, token) VALUES (:email, :token) ON DUPLICATE KEY UPDATE token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Construct the reset link with the generated token
        $resetLink = "https://novelnest.id.vn/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $body = "Click <a href='$resetLink'>here</a> to reset your password.";

        // Send the email with the reset link
        if (sendEmail($email, $subject, $body)) {
            echo "Reset link has been sent to your email.";
        } else {
            echo "Failed to send reset link. Please try again.";
        }
    } else {
        echo "No user found with this email address.";
    }
}
?>
