<?php
include_once '../Controller/LaborContractController.php';

$laborContractController = new LaborContractController();
$laborContracts = $laborContractController->getAllLaborContractOfUser();

if (is_array($laborContracts) && !empty($laborContracts)) {
    $currentDate = date('Y-m-d'); // Lấy ngày hiện tại

    // Start HTML content
    ?>
    <style>
        .Valid {
            background-color: #d4edda; 
            padding: 2px 5px; 
            border-radius: 3px; 
        }
        .Expired {
            background-color: #f8d7da; 
            padding: 2px 5px;
            border-radius: 3px;
        }
    </style>
    <div class="container">
        <h1 class="mt-5 mb-4">List of Labor Contracts</h1>
        <hr>
        <div class="table-responsive">

        <table class="table table-striped" style="text-align: center;" id="tblLabor">
            <thead class="table-dark" >
                <tr>
                    <th>ID</th>
                    <th>LaborName</th>
                    <th>Full Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Sign Day</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($laborContracts as $contract) : ?>
                    <tr>
                        <td><?php echo $contract['LaborID']; ?></td>
                        <td><?php echo $contract['LaborName']; ?></td>
                        <td><?php echo $contract['FullName']; ?></td>
                        <td><?php echo $contract['StartDate']; ?></td>
                        <td><?php echo $contract['EndDate']; ?></td>
                        <td><?php echo $contract['SignDay']; ?></td>
                        <td>
                            <?php
                            // So sánh ngày hiện tại với ngày kết thúc của hợp đồng
                            if ($currentDate <= $contract['EndDate']) {
                                echo '<span class="Valid">Còn hạn</span>';
                            } else {
                                echo '<span class="Expired">Hết hạn</span>';
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
    echo "No labor contracts found.";
}
?>
<script>
    new DataTable('#tblLabor');
</script>