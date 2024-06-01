<?php
// Include các file cần thiết
include_once '../Controller/UserController.php';
include_once '../Controller/DepartmentController.php'; 
include_once '../Controller/PositionController.php';

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
$departmentController = new DepartmentController();

$departments = $departmentController->index();
$positionController = new PositionController();
$positions = $positionController->getAllPositions();
?>
<style>


        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .back-btn {
            font-size: 24px;
            color: #007bff;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }

        .back-btn:hover {
            color: #0056b3;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            display: flex;
            align-items: flex-start;
            padding: 20px;
        }

        .card-body img {
            margin-right: 20px;
            max-width: 200px;
            height: auto;
            border-radius: 8px;
        }

        .card-body div {
            flex: 1;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.5 10l7.5 10 7.5-10H7.5z' fill='%23007bff'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
<div class="container">
        <a href="?page=listEmployee" class="back-btn">&#8592; Back to Employee List</a>
        <?php if (isset($success_message)) : ?>
            <div class="message success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if (isset($error_message)) : ?>
            <div class="message error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                Nhân viên: <?php echo htmlspecialchars($user['FullName']); ?>
            </div>
            <div class="card-body">
            
                <div>
                    <form  id="editForm" action="?page=update_employee" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="userId" id="userId" value="<?php echo htmlspecialchars($userId); ?>">
                        <input type="hidden" name="existingImage" value="<?php echo htmlspecialchars($user['ImageURL']); ?>">
                        <div>
                            <!-- Hiển thị ảnh hiện tại -->
                            <?php if (!empty($user['ImageURL'])): ?>
                                <img src="../img/<?php echo htmlspecialchars($user['ImageURL']); ?>" alt="User Image">
                            <?php endif; ?>
                            
                            <!-- Form input cho việc chọn ảnh mới -->
                            <label for="img">Select New Image:</label>
                            <input type="file" name="img" id="img" accept="image/*">
                        </div>
                        <label for="fullName">Full Name:</label>
                        <input type="text" name="fullName" id="fullName" value="<?php echo htmlspecialchars($user['FullName']); ?>" required>
                        <label for="deptID">Department:</label>
                        <select name="deptID" id="deptID" required>
                            <?php foreach ($departments as $department) : ?>
                                <option value="<?php echo htmlspecialchars($department['DeptID']); ?>" <?php if ($user['DeptID'] == $department['DeptID']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($department['DeptName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="positionID">Position:</label>
                        <select name="positionID" id="positionID" required>
                            <?php foreach ($positions as $position) : ?>
                                <option value="<?php echo htmlspecialchars($position['PositionID']); ?>" <?php if ($user['PositionID'] == $position['PositionID']) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($position['PositionName']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
                        
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['Phone']); ?>" required>
                        
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['Address']); ?>" required>
                        
                        <label for="gender">Gender:</label>
                        <select name="gender" id="gender" required>
                            <option value="Nam" <?php if ($user['Gender'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if ($user['Gender'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                        </select>
                        
                        <label for="birthday">Birthday:</label>
                        <input type="date" name="birthday" id="birthday" value="<?php echo htmlspecialchars($user['Birthday']); ?>" required>
                        
                        <label for="status">Status:</label>
                        <select name="status" id="status" required>
                            <option value="Thực tập" <?php if ($user['Status'] == 'Thực tập') echo 'selected'; ?>>Thực tập</option>
                            <option value="Đã nghỉ việc" <?php if ($user['Status'] == 'Đã nghỉ việc') echo 'selected'; ?>>Đã nghỉ việc</option>
                            <option value="Đang làm việc" <?php if ($user['Status'] == 'Đang làm việc') echo 'selected'; ?>>Đang làm việc</option>
                        </select>

                        
                        <input type="submit" value="Save Changes">
                    </form>
                    <div id="message"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#editForm').submit(function(e){
            e.preventDefault();
            var userId = $('#userId').val();
            var formData = $(this).serialize(); // Lấy toàn bộ dữ liệu của form
            
            // Gửi dữ liệu thông qua Ajax
            $.ajax({
                type: 'POST',
                url: 'update_employee.php', // Tên file PHP xử lý dữ liệu
                data: formData,
                success: function(response){
                    $('#message').html(response); // Hiển thị thông báo từ file PHP
                }
            });
        });
    });
</script> -->