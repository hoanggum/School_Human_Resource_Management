<?php
    // Include necessary files
    include_once '../Controller/RateController.php';
    
    // Create an instance of RateController
    $rateController = new RateController();
    if(isset($_POST['submit'])){
        $userID = $_POST['Employee'];
        $date = $_POST['Date'];
        $reason = $_POST['Reason'];
        $classifil = 'Kỹ luật';
        // Call the method to add the reward entry
        $result = $rateController->addRate($classifil, $date, $reason, $userID);
        if ($result) {
            $success_message = "Discipline has been added successfully";
            $redirect_url = "/admin/index.php?page=listDiscipline";
        } else {
            $error_message = "Failed to add Discipline. Please try again..";
        }
    }
    echo "<script>";
    if (isset($success_message)) {
        echo "alert('$success_message');";
    }
    if (isset($error_message)) {
        echo "alert('$error_message');";
    }
    echo "window.location='$redirect_url';";
    echo "</script>";
?>
