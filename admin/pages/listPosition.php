<?php
include_once '../Controller/PositionController.php';

$positionController = new PositionController();
$positions = $positionController->getAllPositions();
?>
<div class="container">
    <h1 class="mb-4">Danh sách chức vụ</h1>
    <div class="table-responsive">

    <table class="table table-striped" id="tblPosition">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên chức vụ</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($positions as $position): ?>
                <tr>
                    <td><?php echo $position['PositionID']; ?></td>
                    <td><?php echo $position['PositionName']; ?></td>
                    <td>
                        <a href="?page=detailPosition&PositionID=<?php echo $position['PositionID']; ?>" title="Chi tiết">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="?page=editPosition&PositionID=<?php echo $position['PositionID']; ?>" title="Sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?page=deletePosition&PositionID=<?php echo $position['PositionID']; ?>" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<script>
    new DataTable('#tblPosition');
</script>