<?php
// Include các file cần thiết
include_once '../Controller/DepartmentController.php';
include_once '../Controller/UserController.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $deptId = $_GET['id'];
    
    $departmentController = new DepartmentController();
    $department = $departmentController->getDepartmentById($deptId);

    if($department) {
        $userController = new UserController();
        $employees = $userController->getEmployeesByDeptId($deptId);
    } else {
        header("Location: listDept.php");
        exit();
    }
} else {
    header("Location: listDept.php");
    exit();
}
?>
<style>
        .container {
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 30px;
            left: 15px;
            font-size: 24px;
            color: #007bff;
            cursor: pointer;
        }
        .next-btn {
            position: absolute;
            top: 30px;
            right: 15px;
            font-size: 24px;
            color: #007bff;
            cursor: pointer;
        }

        .back-btn:hover {
            color: #0056b3;
        }
        .card-body {
            text-align: center; 
        }

        .card-title {
            color: #007bff; 
        }
        .employee-image {
            width: 90px; 
            height: auto; 
            float: right; 
        }
        .table td {
            font-size: 14px; 
        }
</style>

    <div class="container mt-5">
        
        <div class="card mb-3">
            <a href="?page=listDept" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>  
            <div class="card-body">
                <h1 class="card-title font-weight-bold text-primary"><?php echo $department[0]['DeptName']; ?></h1>
                <p class="card-text"><strong>Địa chỉ:</strong> <?php echo $department[0]['Location']; ?></p>
            </div>
            <a href="?page=detailDept&id=<?php echo $deptId+1?>" class="next-btn"><i class="fa-solid fa-arrow-right"></i></a>  

            
        </div>
        <h2>Danh sách nhân viên</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Chức vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $key => $employee): ?>
                <tr>
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><img class="employee-image" src="../img/<?php echo $employee['ImageURL']; ?>" alt="Hình ảnh nhân viên"></td>
                    <td><?php echo $employee['FullName']; ?></td>
                    <td><?php echo $employee['Birthday']; ?></td>
                    <td><?php echo $employee['Gender']; ?></td>
                    <td><?php echo $employee['Email']; ?></td>
                    <td><?php echo $employee['Address']; ?></td>
                    <td><?php echo $employee['Phone']; ?></td>
                    <td><?php echo $employee['positionName']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

