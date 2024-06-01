<?php
// Include necessary files
include_once '../Controller/UserController.php';

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $userId = intval($_POST['userId']);
    $fullName = $_POST['fullName'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $departmentID = $_POST['deptID'];
    $positionID = $_POST['positionID'];
    $status = $_POST['status'];

    // Handle image upload
    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        $imgName = $_FILES['img']['name'];
        $imgTmp = $_FILES['img']['tmp_name'];
        $imgPath = "../img/" . $imgName;
        move_uploaded_file($imgTmp, $imgPath);
    } else {
        $imgName = $_POST['existingImage']; // Keep the existing image if no new image is uploaded
    }


    // Update employee details
    $result = $userController->updateEmployee($userId, $fullName, $birthday, $gender, $email, $address, $phone, $positionID, $departmentID, $imgName, $status);

    if ($result) {
        $success_message = "Employee details have been updated successfully.";
        $redirect_url = "/admin/index.php?page=listEmployee";
    } else {
        $error_message = "Failed to update Employee details. Please try again.";
    }

    // Redirect or show messages
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

}
?>
