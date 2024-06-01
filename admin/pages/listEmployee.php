<?php
// Include các file cần thiết
include_once '../Controller/UserController.php';

$userController = new UserController();
$employees = $userController->getAllEmployee();

// Kiểm tra nếu $employees là một mảng hợp lệ trước khi sử dụng nó
if(is_array($employees) && !empty($employees)) {
    
?>
<style>
        .container {
            position: relative;
        }
        .working {
            background-color: #d4edda; /* Màu nền xanh nhạt cho trạng thái "Đang làm việc" */
            padding: 2px 5px; /* Điều chỉnh đệm để tạo hiệu ứng light */
            border-radius: 3px; /* Bo tròn góc */
        }

        .probation {
            background-color: #ffeeba; /* Màu nền vàng nhạt cho trạng thái "Thử việc" */
            padding: 2px 5px;
            border-radius: 3px;
        }

        .resigned {
            background-color: #f8d7da; /* Màu nền đỏ nhạt cho trạng thái "Đã nghỉ việc" */
            padding: 2px 5px;
            border-radius: 3px;
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
        .search-container {
            margin-bottom: 20px;
            /* Sử dụng flexbox để căn chỉnh thành phần */
            display: flex;
        }
        #searchInput{
            background-color:floralwhite ;
        }
        .search-container input[type=text] {
            padding: 10px; /* Đặt kích thước đệm */
            margin-top: 8px;
            font-size: 17px;
            border: none;
            border-radius: 5px; /* Bo tròn góc */
            /* Sử dụng flex-grow để kéo dài ra */
            flex-grow: 1;
        }
        .search-container button {
            padding: 10px 15px; /* Đặt kích thước đệm */
            margin-top: 8px;
            margin-left: 5px;
            background:black;
            font-size: 17px;
            border: none;
            border-radius: 5px; /* Bo tròn góc */
            cursor: pointer;
            color: white;
        }
        .search-container button:hover {
            background: gray;
        }
        .import-export-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .import-export-container form,
    .import-export-container button {
        display: inline-block;
    }
    .import-export-container input[type="file"] {
        display: inline-block;
        padding: 10px;
        font-size: 17px;
        border: none;
        border-radius: 5px;
    }
    .import-export-container button {
        padding: 10px 15px;
        background: black;
        font-size: 17px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white;
    }
    .import-export-container button:hover {
        background: gray;
    }
</style>

<div class="container">
    
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm...">
            <button type="button" onclick="search()">Tìm kiếm</button>
        </div>
        <h1>Danh sách nhân viên</h1>
        <div class="import-export-container">
        <form action="?page=importData" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" accept=".xlsx, .xls">
            <button type="submit" name="importSubmit">Import</button>
        </form>
        <button type="button" onclick="exportToExcel()">Export</button>
    </div>
        <div class="table-responsive">

        <table class="table" id="employeeTable">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($employees as $key => $employee): ?>
                <tr onclick="window.location.href='?page=detailEmployee&userId=<?php echo $employee['UserID']; ?>'">
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><img class="employee-image" src="../img/<?php echo $employee['ImageURL']; ?>" alt="Hình ảnh nhân viên"></td>
                    <td><?php echo $employee['FullName']; ?></td>
                    <td><?php echo $employee['Birthday']; ?></td>
                    <td><?php echo $employee['Gender']; ?></td>
                    <td><?php echo $employee['Email']; ?></td>
                    <td><?php echo $employee['Address']; ?></td>
                    <td><?php echo $employee['Phone']; ?></td>
                    <td><?php echo $employee['positionName']; ?></td>
                    <td>
                        <?php
                            if ($employee['Status'] == 'Đang làm việc'){
                                echo '<span class="working">'. $employee['Status']. '</span>';
                            }
                            elseif ($employee['Status'] == 'Thực tập') {
                                echo '<span class="probation">'. $employee['Status']. '</span>';
                            }
                            else{
                                echo '<span class="resigned">'. $employee['Status']. '</span>';
                            }
                        ?>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
<?php
} else {
    echo "Không có nhân viên nào được tìm thấy.";
}
?>
<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable();
    });
        function search() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("employeeTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var display = "none";

                for (j = 0; j < tr[i].cells.length; j++) {
                    td = tr[i].cells[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            display = "";
                            break;
                        }
                    }
                }
                tr[i].style.display = display;
            }
        }
        function exportToExcel() {
            window.location.href = '?page=exportExcel';
        }
</script>

