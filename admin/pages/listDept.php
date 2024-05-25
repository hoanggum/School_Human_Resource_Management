<?php 

include_once '../Controller/DepartmentController.php'; 

$departmentController = new DepartmentController();

$departments = $departmentController->index();
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    
                    <h2 id="index" class="fl-left">Danh sách phòng ban</h2>
                    <hr>
                  
                    <!-- Thêm nút "Thêm mới" -->
                    
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp" id="tblDept">
                        <thead class="table-dark">
                            <tr>
                                <th>STT</th>
                                <th>Tên phòng ban</th>
                                <th>Địa chỉ</th>
                                <th>Thao tác</th> <!-- Thêm cột mới cho các thao tác -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departments as $key => $dept) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td>
                                        <a href="?page=detailDept&id=<?php echo $dept['DeptID']; ?>" title=""><?php echo $dept['DeptName']; ?></a>
                                    </td>
                                    <td><?php echo $dept['Location']; ?></td>
                                    <!-- Thêm cột mới cho các thao tác -->
                                    <td>
                                        <!-- Liên kết sửa -->
                                        <a href="?page=detailDept&id=<?php echo $dept['DeptID']; ?>" title="Chi tiết">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="?page=editDept&id=<?php echo $dept['DeptID']; ?>" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Liên kết xóa -->   
                                        <a href="?page=deleteDept&id=<?php echo $dept['DeptID']; ?>" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
    new DataTable('#tblDept');
</script>