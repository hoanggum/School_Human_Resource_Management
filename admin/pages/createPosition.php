<?php
// Include the PositionController
include_once '../Controller/PositionController.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $positionName = $_POST['positionName'];

    // Validate the form data (you can add more validation if needed)

    // Create a new instance of PositionController
    $positionController = new PositionController();

    // Add the new position
    $result = $positionController->addPosition($positionName);

    // Check if the position was added successfully
    if ($result) {
        // Set success message and redirect URL
        $success_message = "Position added successfully.";
        $redirect_url = "?page=listPosition";
    } else {
        // Set error message and redirect URL
        $error_message = "Failed to add the position. Please try again.";
        $redirect_url = "?page=addPosition"; // Assuming this is the page where the form is located
    }

    // Output JavaScript to display alerts and redirect
    echo "<script>";
    if (!empty($success_message)) {
        echo "alert('$success_message');";
    }
    if (!empty($error_message)) {
        echo "alert('$error_message');";
    }
    echo "window.location='$redirect_url';";
    echo "</script>";
    exit();
}
?>
<style>
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
    }

    .mb-3 {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(0,123,255,.25);
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .alert {
        margin-top: 20px;
    }
</style>

<div class="container">
    <h1 class="mb-4">Thêm chức vụ mới</h1>
    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="positionName" class="form-label">Tên chức vụ</label>
            <input type="text" class="form-control" id="positionName" name="positionName" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm chức vụ</button>
    </form>
</div>
