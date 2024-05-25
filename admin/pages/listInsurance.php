<?php
    // Import controler và model
    include_once '../Controller/InsuranceController.php';
    $insuranceController = new InsuranceController();

    // Lấy danh sách bảo hiểm từ controler
    $insurances = $insuranceController->getAllInsurancesOfEmployees();
?>

<!-- Hiển thị danh sách bảo hiểm -->
<div class="container">
    <h1>List of Insurances</h1>
    <div class="table-responsive">

    <table class="table" id="tblInsurance">
        <thead class="table-dark">
            <tr>
                <th scope="col">Insurance ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Pay Date</th>
                <th scope="col">Grant By</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($insurances as $insurance): ?>
                <tr>
                    <td><?php echo $insurance['InsuranceID']; ?></td>
                    <td><?php echo $insurance['FullName']; ?></td>
                    <td><?php echo $insurance['PayDate']; ?></td>
                    <td><?php echo $insurance['GrantBy']; ?></td>
                    <td>
                        <a href="?page=editInsurance&InsuranceID=<?php echo $insurance['InsuranceID']; ?>" class="btn btn-primary">Edit</a>
                        <a href="?page=deleteInsurance&InsuranceID=<?php echo $insurance['InsuranceID']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<script>
    new DataTable('#tblInsurance');
</script>