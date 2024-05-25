<?php
include_once '../Controller/RateController.php';

$rateController = new RateController();
$classified ='Kỹ luật';

if(isset($_POST['filter'])) {
    $filterMonth = $_POST['filterMonth'];
    $filterYear = $_POST['filterYear'];
    $rewards = $rateController->getRatesByMonthAndYear($classified,$filterMonth, $filterYear);
}
else{
    $rewards = $rateController->getRatesByClassified($classified);
}
function generateMonthOptions($selectedMonth) {
    $currentMonth = date('n');
    $months = array(
        1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6',
        7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12'
    );

    $options = '';
    foreach ($months as $month => $name) {
        $selected = ($selectedMonth == $month || (!$selectedMonth && $currentMonth == $month)) ? 'selected' : '';
        $options .= "<option value='$month' $selected>$name</option>";
    }

    return $options;
}

function generateYearOptions($startYear, $endYear, $selectedYear) {
    $currentYear = date('Y');
    $options = '';
    for ($year = $startYear; $year <= $endYear; $year++) {
        $selected = ($selectedYear == $year || (!$selectedYear && $currentYear == $year)) ? 'selected' : '';
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
<div class="container mt-5">
    <h1 class="mt-5 mb-4" style="text-align: center; color: rgb(0, 9, 35); font-size: 28px; font-weight: bold;">Danh sách Kỹ luật</h1>
    <button type="button" class="btn btn-dark" style="width: 6%;height: 12%;" onclick="window.location.href = '?page=createDiscipline'">
        <i class="fas fa-plus"></i> <!-- Biểu tượng dấu cộng (+) -->
    </button>
    <hr>
    <!-- Filter Form -->
    <form action="" method="post" class="mb-4">
        <div class="row justify-content-end">
            <div class="col-md-3">
                    <select name="filterMonth" class="form-select">
                        <?php echo generateMonthOptions($filterMonth); ?>
                    </select>
            </div>
            <div class="col-md-3">
                <select name="filterYear" class="form-select">
                    <?php echo generateYearOptions(2015, 2040, $filterYear); ?> 
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="filter" class="btn btn-dark" style="width: 100px;height: 100%;"><i class="fa-solid fa-filter"></i> Filter </button>
            </div>
        </div>
    </form>
    <!-- Table of Rewards -->
    <div class="table-responsive">

    <table class="table table-bordered" id="tblDiscipline">
        <thead class="table-dark" >
            <tr>
                <th scope="col">RateID</th>
                <th scope="col">Tên nhân viên</th>
                <th scope="col">Classified</th>
                <th scope="col">RDate</th>
                <th scope="col">Reason</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rewards as $reward): ?>
                <tr>
                    <td><?php echo $reward['RateID']; ?></td>
                    <td><?php echo $reward['FullName']; ?></td>
                    <td><?php echo $reward['Classifiled']; ?></td>
                    <td><?php echo $reward['RDate']; ?></td>
                    <td><?php echo $reward['Reason']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<script>
    new DataTable('#tblDiscipline');
</script>
