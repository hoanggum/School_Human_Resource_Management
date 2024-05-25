<?php
// Include các file cần thiết
include_once '../Controller/UserController.php';

$userController = new UserController();

// Get the user ID from the query string
$userId = isset($_GET['userId']) ? intval($_GET['userId']) : 0;

if ($userId > 0) {
    // Get user details by ID
    $userDetails = $userController->getUserDetailsById($userId);

    if (!empty($userDetails)) {
        $user = $userDetails[0];
    } else {
        echo "No details found for the specified user.";
        exit;
    }
} else {
    echo "Invalid user ID.";
    exit;
}
?>
<style>
        .back-btn {
            font-size: 24px;
            color: #007bff;
        }
        .back-btn:hover {
            color: #0056b3;
        }
        .card-body {
            display: flex;
            align-items: flex-start;
        }
        .card-body img {
            margin-right: 34px;
            margin-left: 10px;

            max-width: 200px;
            height: auto;
            border-radius: 8px;
        }
        .card-body div {
            flex: 1;
        }
  
</style>
<div class="container mt-5">
    <a href="?page=listEmployee" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>  
    <hr>


    <div class="card">
        <div class="card-header text-center">
            <h2><?php echo htmlspecialchars($user['FullName']); ?></h2>
        </div>
        <div class="card-body">
            <?php if (!empty($user['ImageURL'])): ?>
                <img src="../img/<?php echo htmlspecialchars($user['ImageURL']); ?>" alt="User Image">
            <?php endif; ?>
            <div>
                <p><strong>Họ và tên:</strong> <?php echo htmlspecialchars($user['FullName']); ?></p>
                <p><strong>Phòng ban:</strong> <?php echo htmlspecialchars($user['deptName']); ?></p>
                <p><strong>Chức vụ:</strong> <?php echo htmlspecialchars($user['positionName']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($user['Phone']); ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($user['Address']); ?></p>
                <p><strong>Giới tính:</strong> <?php echo htmlspecialchars($user['Gender']); ?></p>
                <p><strong>Ngày sinh:</strong> <?php echo htmlspecialchars($user['Birthday']); ?></p>
                <p><strong>Degree:</strong></p>

                <p><strong>Trạng thái:</strong> <?php echo htmlspecialchars($user['Status']); ?></p>
            </div>
        </div>
    </div>
</div>