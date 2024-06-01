<?php
// Include the necessary files
include_once '../Controller/UserController.php'; 
require_once '../vendor/autoload.php'; // Ensure you have PhpSpreadsheet installed via Composer

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$userController = new UserController();

if(isset($_POST['importSubmit'])){

    // Allowed mime types
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)){

        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet_arr = $worksheet->toArray();

            // Remove header row
            unset($worksheet_arr[0]);

            foreach($worksheet_arr as $row){
                // Check if the row is not empty
                if (!empty(array_filter($row))) {
                    // Extract data from each row
                    $fullName = $row[0];
                    $birthday = $row[1];
                    $gender = $row[2];
                    $email = $row[3];
                    $address = $row[4];
                    $phone = $row[5];
                    $username = $row[6];
                    $positionID = $row[7];
                    $deptID = $row[8];
                    $imgName = 'nv1.jpg';
                    $status = $row[9];

                    // Call the method to add data to the database using the function from UserController
                    $result = $userController->addEmployee($fullName, $birthday, $gender, $email, $address, $phone, $username, $positionID, $deptID, $imgName, $status);

                    // Check the result and display the corresponding message
                    if ($result) {
                        $success_message = "Dữ liệu đã được nhập thành công từ tệp Excel.";
                    } else {
                        $error_message = "Có lỗi xảy ra trong quá trình nhập dữ liệu.";
                    }
                }
            }

            $redirect_url = "/admin/index.php?page=listEmployee";
        }else{
            $error_message = "Thêm không thành công";
            $redirect_url = "/admin/index.php?page=listEmployee";
        }
    }else{
        $error_message = "Không tìm thấy file";
        $redirect_url = "/admin/index.php?page=listEmployee";
    }
}

// Redirect to the listing page
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
