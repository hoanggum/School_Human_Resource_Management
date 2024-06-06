<?php
include_once '../Controller/DegreeController.php';

// Create an instance of DegreeController
$degreeController = new DegreeController();

// Get all degrees
$degrees = $degreeController->getAllDegreesWithFullName();
?>
<div class="container mt-5">
<h1 class="mt-5 mb-4" style="text-align: center; color: rgb(0, 9, 35); font-size: 28px; font-weight: bold;">Danh sách Kỹ luật</h1>
    <button type="button" class="btn btn-dark" style="width: 6%; height: 12%;" onclick="window.location.href = '?page=createDegree'">
            <i class="fas fa-plus"></i> <!-- Biểu tượng dấu cộng (+) -->
    </button>
    <h1 class="mb-4">List of Degrees</h1>
    <div class="table-responsive">
        <table class="table" id="degreeTable">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th>Degree ID</th>
                    <th>Full Name</th>
                    <th>Degree Name</th>
                    <th>Granted Date</th>
                    <th>Unit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($degrees as $degree): ?>
                    <tr>
                        <td><?php echo $degree['DegreeID']; ?></td>
                        <td><?php echo $degree['FullName']; ?></td>
                        <td><?php echo $degree['DegreeName']; ?></td>
                        <td><?php echo $degree['GrantedDate']; ?></td>
                        <td><?php echo $degree['Unit']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new DataTable('#degreeTable');
    });
</script>
