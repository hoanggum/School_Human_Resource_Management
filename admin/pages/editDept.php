<?php
include_once '../Controller/DepartmentController.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $deptId = $_GET['id'];
    
    $departmentController = new DepartmentController();
    
    $department = $departmentController->getDepartmentById($deptId);
} else {
    header("Location: ?page=listDept");
    exit();
}
?>
<style>
        .custom-container {
            margin-top: 50px; /* Khoảng cách từ container đến top */
            max-width: 500px; /* Chiều rộng tối đa của container */
            background-color: #fff; /* Màu nền trắng */
            padding: 20px; /* Khoảng cách giữa nội dung và viền container */
            border-radius: 10px; /* Bo tròn viền container */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
            margin-left: auto; /* Canh trái container vào giữa trang */
            margin-right: auto; /* Canh phải container vào giữa trang */
        }
        .custom-form-control {
            width: 100%; /* Đặt chiều rộng của nút lưu thay đổi */
        }
        .form-group {
            display: flex; /* Sử dụng Flexbox */
            align-items: center; /* Căn chỉnh các phần tử theo chiều dọc */
            margin-bottom: 20px; /* Khoảng cách giữa các form group */
        }
        .form-group label {
            flex: 0 0 30%; /* Chiếm 30% chiều rộng của form group */
            margin-bottom: 0; /* Không để margin-bottom cho label */
            padding-right: 20px; /* Khoảng cách giữa label và input */
            text-align: right; /* Căn chỉnh văn bản của label sang phải */
        }
        .form-group input {
            flex: 0 0 70%; /* Chiếm 70% chiều rộng của form group */
        }
        .custom-form-control {
            width: 100%; /* Đặt chiều rộng của nút lưu thay đổi */
        }
        h2 {
            text-align: center; /* Căn giữa chữ in */
            color: blue; /* Đổi màu chữ */
        }   
    </style>
<div class="custom-container">
        <h2 class="mt-5">Sửa thông tin phòng ban</h2>
        <hr>
        <form action="?page=updateDept&id=<?php echo $deptId?>" method="post" class="mt-4" enctype="multipart/form-data">
            <div class="form-group">
                <!-- Mã phòng ban -->
                <input type="hidden" name="deptId" value="<?php echo $department[0]['DeptID']; ?>">
            </div>
            <div class="form-group">
                <label for="deptName">Tên phòng ban:</label>
                <input type="text" id="deptName" name="deptName" value="<?php echo $department[0]['DeptName']; ?>" class="custom-form-control">
            </div>
            <div class="form-group">
                <label for="location">Địa chỉ:</label>
                <input type="text" id="location" name="location" value="<?php echo $department[0]['Location']; ?>" class="custom-form-control">
            </div>
        <button type="submit" class="btn btn-primary custom-form-control">Lưu thay đổi</button>
    </form>
</div>
<script>
        document.getElementById("deptName").focus();
</script>