<?php
include_once '../Controller/DegreeController.php';

// Create an instance of DegreeController
$degreeController = new DegreeController();

// Get all degrees
$degrees = $degreeController->getAllDegreesWithFullName();
?>
<div class="container mt-5">
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
