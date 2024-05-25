<?php 
// Include SalaryController
include_once '../Controller/SalaryController.php'; 

// Khởi tạo một đối tượng SalaryController
$salaryController = new SalaryController();

$salaries = $salaryController->getAllSalariesAndTimesheet();
?>

<!-- Phần HTML để hiển thị danh sách bảng lương -->
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h2 id="index" class="fl-left">Danh sách bảng lương</h2>
                    <hr>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table table-striped" id="myTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Hình ảnh</th>
                                    <th>Họ tên</th>
                                    <th>Ngày chốt lương</th>  
                                    <th>Lương cơ bản</th>
                                    <th>Phụ cấp</th>
                                    <th>Lương ứng</th>
                                    <th>Số ngày làm</th>
                                    <th>Số ngày phép</th>
                                    <th>Số ngày không phép</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày nhận lương</th>
                                    <th>Tình trạng</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($salaries as $key => $salary) : ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><img class="employee-image" src="../img/<?php echo $salary['Url']; ?>" alt="<?php echo $salary['FullName']; ?>" style="width: 50px; height: auto;"></td>
                                        <td><?php echo $salary['FullName']; ?></td>
                                        <td><?php echo $salary['SDate']; ?></td>
                                        <td><?php echo $salary['Basic']; ?></td>
                                        <td><?php echo $salary['Allowance']; ?></td>
                                        <td><?php echo $salary['Advance']; ?></td>                                        
                                        <td><?php echo $salary['WorkedDay']; ?></td>
                                        <td><?php echo $salary['AuthorizedAbsences']; ?></td>
                                        <td><?php echo $salary['UnauthorizedAbsences']; ?></td>
                                        <td><?php echo $salary['Total']; ?></td>
                                        <td><?php echo $salary['Payday']; ?></td>
                                        <td><?php echo $salary['Status']; ?></td>
                                        <td>
                                            <a href="?page=editSalary&salaryId=<?php echo $salary['SalaryID']; ?>" title="Edit"><i class="fas fa-edit"></i></a>
                                            <a href="?page=deleteSalary&salaryId=<?php echo $salary['SalaryID']; ?>" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#myTable');
</script>