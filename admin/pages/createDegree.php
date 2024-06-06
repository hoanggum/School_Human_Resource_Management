<?php
include_once '../Controller/UserController.php';
include_once '../Controller/DegreeController.php';
$userController = new UserController();
$users = $userController->getAllUser();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $degreeController = new DegreeController();

    // Get form data
    $userID = $_POST['UserID'];
    $degreeName = $_POST['degreeName'];
    $grantedDate = $_POST['grantedDate'];
    $unit = $_POST['unit'];

    // Validate form data
    if (empty($userID) || empty($degreeName) || empty($grantedDate) || empty($unit)) {
        $error_message = "Vui lòng điền tất cả các trường.";
    } else {
        // Call the method to add a new degree
        if ($degreeController->addDegree($degreeName, $grantedDate, $unit, $userID)) {
            $success_message = "Thêm bằng cấp thành công!";
        } else {
            $error_message = "Có lỗi xảy ra. Vui lòng thử lại.";
        }
    }

    // Display success or error message and redirect
    echo "<script>";
    if (!empty($success_message)) {
        echo "alert('$success_message');";
    }
    if (!empty($error_message)) {
        echo "alert('$error_message');";
    }
    echo "window.location='$redirect_url';";
    echo "</script>";
    exit();
}
?>
 <style>
        .form-label, .form-control, .form-select, .btn {
            font-size: 1.7rem; /* Adjust font size to make text larger */
        }
        .container {
            max-width: 1000px; /* Set max-width for better layout on large screens */
        }
        h1 {
            font-size: 5rem; /* Increase font size for the main heading */
        }
    </style>
<div class="container mt-5">
    <h1 class="mt-5 mb-4 text-center" style="color: rgb(0, 9, 35); font-size: 28px; font-weight: bold;">Thêm Bằng Cấp</h1>
    <div class="card p-4">
        <form method="post" action="?page=createDegree" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="UserID" class="form-label">Chọn nhân viên</label>
                <select class="form-select" id="UserID" name="UserID">
                    <?php
                        foreach ($users as $user) {
                            echo '<option value="' . $user['UserID'] . '">' . $user['FullName'] . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="degreeName" class="form-label">Tên Bằng Cấp</label>
                <input type="text" class="form-control" id="degreeName" name="degreeName" required>
            </div>
            <div class="mb-3">
                <label for="grantedDate" class="form-label">Ngày Cấp</label>
                <input type="date" class="form-control" id="grantedDate" name="grantedDate" required>
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Đơn Vị cấp</label>
                <input type="text" class="form-control" id="unit" name="unit" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Thêm Bằng</button>
        </form>
    </div>
</div>