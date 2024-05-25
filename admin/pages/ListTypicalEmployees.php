<?php
include_once '../Controller/RateController.php';

$rateController = new RateController();
$disciplineList = $rateController->getRatesByClassified('Kỹ luật');
$rewardList = $rateController->getRatesByClassified('Khen thưởng');
?>
<style>
    .employee-image {
        width: 50px; /* Kích thước hình ảnh */
        height: 50px; /* Kích thước hình ảnh */
        float: left; /* Căn hình ảnh sát bên trái */
        margin-right: 10px; /* Khoảng cách giữa hình ảnh và chữ */
        border-radius: 10%; /* Bo tròn hình ảnh */
    }

    .employee-name {
        display: block; /* Hiển thị chữ trên một dòng */
        line-height: 50px; /* Căn giữa văn bản theo chiều dọc */
    }


</style>
<div class="container">
    <div class="col-md-7 mx-auto">
            <h1 class="mb-4 text-center">Danh sách nhân viên được khen thưởng</h1>
            <ul class="list-group">
                <?php foreach ($rewardList as $employee): ?>
                    <li class="list-group-item">
                    <img class="employee-image" src="../img/<?php echo $employee['Url']; ?>" alt="Hình ảnh nhân viên">
                    <span class="employee-name"><?php echo $employee['FullName']; ?></span>
                    <div class="clearfix"></div>
                </li>             
                <?php endforeach; ?>
        </ul>
    </div>
</div>
