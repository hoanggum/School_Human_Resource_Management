<?php
include_once '../Controller/ScheduleController.php';
$scheduleController = new ScheduleController();

if(isset($_POST['filter'])){
    $currentMonth = $_POST['month'];
    $currentYear = $_POST['year'];
    $filteredSchedules = $scheduleController->getScheduleByMonth($currentMonth, $currentYear);
} else {
    $filteredSchedules = $scheduleController->getScheduleOfUser();
}
function generateMonthOptions($selectedMonth) {
    // Mảng chứa các tên tháng
    $months = array(
        1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6',
        7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12'
    );

    // Tạo options cho dropdown
    $options = '';
    foreach ($months as $month => $name) {
        // Kiểm tra nếu tháng hiện tại trùng với tháng được chọn, thêm thuộc tính selected
        $selected = ($selectedMonth == $month) ? 'selected' : '';

        // Thêm option vào danh sách
        $options .= "<option value='$month' $selected>$name</option>";
    }

    return $options;
}


// Tạo option cho năm

function generateYearOptions($startYear, $endYear, $selectedYear) {
    // Tạo options cho dropdown từ năm bắt đầu đến năm kết thúc
    $options = '';
    for ($year = $startYear; $year <= $endYear; $year++) {
        // Kiểm tra nếu năm hiện tại trùng với năm được chọn, thêm thuộc tính selected
        $selected = ($selectedYear == $year) ? 'selected' : '';

        // Thêm option vào danh sách
        $options .= "<option value='$year' $selected>$year</option>";
    }

    return $options;
}
?>
<style>
        .form-select {
            font-size: 16px; /* Điều chỉnh kích thước chữ ở đây */
        } 
</style>
<div class="container">
        <h1 class="mt-5 mb-4" style="text-align: center; color: rgb(0, 9, 35); font-size: 28px; font-weight: bold;">Lịch công tác</h1>
        <hr>
        <form action="" method="post" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <select name="month" class="form-select">
                        <?php echo generateMonthOptions($currentMonth); ?>

                    </select>
                </div>
                <div class="col-md-4">
                    <select name="year" class="form-select">
                    <?php echo generateYearOptions(2015, 2040, $currentYear); ?> 
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="filter" class="btn btn-dark" style="width: 100px;height: 100%;"><i class="fa-solid fa-filter"></i> Filter </button>
                </div>
            </div>
        </form>
        <div class="table-responsive">

        <table class="table table-bordered" id="tableSchedule">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ScheduleID</th>
                    <th scope="col">FullName</th>
                    <th scope="col">StartDate</th>
                    <th scope="col">EndDate</th>
                    <th scope="col">WorkPlace</th>
                    <th scope="col">Descriptions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredSchedules as $schedule): ?>
                    <tr>
                        <td><?php echo $schedule['ScheduleID']; ?></td>
                        <td><?php echo $schedule['FullName']; ?></td>
                        <td><?php echo $schedule['StartDate']; ?></td>
                        <td><?php echo $schedule['EndDate']; ?></td>
                        <td><?php echo $schedule['WorkPlace']; ?></td>
                        <td><?php echo $schedule['Descriptions']; ?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        </div>
</div>

<script>
    new DataTable('#tableSchedule');
</script>