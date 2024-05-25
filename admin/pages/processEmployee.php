<?php
include_once '../Controller/UserController.php';

$userController = new UserController();

if(isset($_POST['submit'])){

    // Lấy dữ liệu từ form
    $fullName = $_POST['fullName'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $departmentID = $_POST['deptID'];
    echo $departmentID;

    $positionID = $_POST['positionID'];
    echo $positionID;

    $status = $_POST['status'];

    // Xử lý ảnh
    if(isset($_FILES['img'])) {
        $imgName = $_FILES['img']['name'];

        $imgTmp = $_FILES['img']['tmp_name'];
        $imgPath = "../img/".$imgName;
        // Di chuyển ảnh vào thư mục uploads
        move_uploaded_file($imgTmp, $imgPath);
    } else {
        $imgName = "user.jpg"; // Nếu không có ảnh, gán giá trị rỗng
    }

    // Gọi phương thức addEmployee từ UserController để thêm nhân viên mới
    $result = $userController->addEmployee($fullName, $birthday, $gender, $email, $address, $phone, $username, $positionID, $departmentID, $imgName,$status);
    echo $result;

    if ($result) {
        echo $result;
        $success_message = "Employee has been added successfully";
        $redirect_url = "/admin/index.php?page=listEmployee";
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
echo "window.location='$redirect_url';";
echo "</script>";
?>
