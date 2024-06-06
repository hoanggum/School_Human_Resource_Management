<?php
// Include necessary files
include_once "connect.php"; // Assuming this file contains your database connection code

// Check if token is provided in the URL
if(isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $sql = "SELECT * FROM password_resets WHERE token = :token";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $resetInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    // If token is valid
    if($resetInfo) {
        // Reset the password to '1'
        $email = $resetInfo['email'];
        $sql = "UPDATE users SET Password = '1' WHERE Email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Delete the password reset token from the password_resets table
        $sql = "DELETE FROM password_resets WHERE token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Display success message using JavaScript alert
        echo '<script>alert("Password reset successfully. Your new password is now \'1\'.");</script>';
    } else {
        // Invalid or expired token
        echo '<script>alert("Invalid token.");</script>';
    }
} else {
    // Token not provided
    echo '<script>alert("Token not provided.");</script>';
}
?>
