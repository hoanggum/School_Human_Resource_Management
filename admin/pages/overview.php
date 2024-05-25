<?php
include_once '../Controller/UserController.php';
include_once '../Controller/DepartmentController.php'; 
include_once '../Controller/RateController.php';

$rateController = new RateController();
$numReward = $rateController->counttRate('Khen thưởng');
$numDiscipline = $rateController->counttRate('Kỹ luật');
$disciplineByMonth = $rateController->getRateByMonth('Kỹ luật');
$disciplineList = $rateController->getRatesByClassified('Kỹ luật');
$rewardList = $rateController->getRatesByClassified('Khen thưởng');

$rewardByMonth = $rateController->getRateByMonth('Khen thưởng');
$labelsReward = array();
$dataReward = array();
$labelsDiscipline = [];
$dataDiscipline = array();
foreach ($rewardByMonth as $row) {
        // Thêm tháng vào mảng nhãn
    $labelsReward[] = date('F', mktime(0, 0, 0, $row['Month'], 1));
        
        // Thêm số phê bình hoặc số khen thưởng vào mảng dữ liệu
    $dataReward[] = intval($row['Count']);
}
foreach ($disciplineByMonth as $row) {
    // Thêm tháng vào mảng nhãn
    $labelsDiscipline[] = date('F', mktime(0, 0, 0, $row['Month'], 1));
    $dataDiscipline[] = intval($row['Count']);
}
$departmentController = new DepartmentController();

$numDept = $departmentController->countDepartments();
$userController = new UserController();
$numberUser = $userController->countUser();
?>
<style>
    .employee-box {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        margin-right: 20px;
        justify-content: center;
        height: 100%;
        background-color: lavender; /* Đảm bảo các cục v có chiều cao bằng nhau */
    }

    .icon {
        font-size: 40px;
        margin-right: 20px;
    }

    .content h2 {
        margin: 0;
    }

    .count {
        font-size: 24px;
        font-weight: bold;
    }
</style>
<div class="row mt-3">
    <div class="col-md-3">
        <a href="?page=listDept">
            <div class="employee-box">
                <div class="icon"><i class="fa-solid fa-building-user"></i></i></div>
                <div class="content">
                    <h2>Phòng ban</h2>
                    <p class="count"><?php echo $numDept[0]['department_count']?></p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="?page=listEmployee">
            <div class="employee-box">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="content">
                    <h2>Nhân viên</h2>
                    <p class="count"><?php echo $numberUser[0]['NumberUser']?></p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="?page=listReward">
            <div class="employee-box" style="background-color:lightcyan;">
                <div class="icon" style="color:aquamarine"><i class="fa-solid fa-star"></i></div>
                <div class="content">
                    <h2>Khen thưởng</h2>
                    <p class="count"><?php echo $numReward[0]['NumberRate']?></p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="?page=listDiscipline">
            <div class="employee-box" style="background-color:lightpink;">
                <div class="icon" style="color:firebrick"><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class="content">
                    <h2>Kỹ luật</h2>
                    <p class="count"><?php echo $numDiscipline[0]['NumberRate']?></p>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row mt-5">
    <!-- Biểu đồ số phê bình theo tháng -->
    <div class="col-md-6 " >
        <canvas id="rewardChart" width="400" height="200"></canvas>
        <div class="mt-3">
            <h3 class="text-center">Danh sách nhân viên được khen thưởng</h3>
            <ul class="list-group">
                <?php foreach ($rewardList as $employee): ?>
                    <li class="list-group-item"><?php echo $employee['FullName']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <!-- Biểu đồ số kỹ luật theo tháng -->
    <div class="col-md-6">
        <canvas id="disciplineChart" width="400" height="200"></canvas>
        <div class="mt-3">
            <h3 class="text-center">Danh sách nhân viên bị kỷ luật</h3>
            <ul class="list-group">
                <?php foreach ($disciplineList as $employee): ?>
                    <li class="list-group-item"><?php echo $employee['FullName']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<script>
 // Biểu đồ số khen thưởng theo tháng
 var rewardCtx = document.getElementById('rewardChart').getContext('2d');
    var rewardData = {
        labels: <?php echo json_encode($labelsReward); ?>,
        datasets: [{
            label: 'Số khen thưởng',
            data: <?php echo json_encode($dataReward); ?>,
            borderColor: 'rgb(75, 192, 192)',
            borderWidth: 2,
            fill: false
        }]
    };
    var rewardChart = new Chart(rewardCtx, {
        type: 'line',
        data: rewardData,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Số khen thưởng theo tháng'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Biểu đồ số kỹ luật theo tháng
    var disciplineCtx = document.getElementById('disciplineChart').getContext('2d');
    var disciplineData = {
        labels: <?php echo json_encode($labelsDiscipline); ?>,
        datasets: [{
            label: 'Số kỹ luật',
            data: <?php echo json_encode($dataDiscipline); ?>,
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 2,
            fill: false
        }]
    };
    var disciplineChart = new Chart(disciplineCtx, {
        type: 'line',
        data: disciplineData,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Số kỹ luật theo tháng'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
