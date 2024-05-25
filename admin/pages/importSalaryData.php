<?php
// Load the database configuration file
include_once '../Controller/SalaryController.php'; 

$salaryController = new SalaryController();
// Include PhpSpreadsheet library autoloader
require_once '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
                // Kiểm tra xem dòng có giá trị không rỗng không
                if (!empty(array_filter($row))) {
                    // Extract data from each row
                    $userID = $row[0];
                    $FullName = $row[1];
                    $sDate = $row[2];
                    $basic = $row[3];
                    $workedDay = $row[4];
                    $authorizedAbsences = $row[5];
                    $unauthorizedAbsence = $row[6];
                    $allowance = $row[7];
                    $advance = $row[8];
                    $total = $row[9];
                

                    // Gọi phương thức để thêm dữ liệu vào cơ sở dữ liệu sử dụng hàm từ SalaryController
                    $result = $salaryController->addSalaryAndTimesheets($sDate, $workedDay, $authorizedAbsences, $unauthorizedAbsence, $userID, $basic, $allowance, $advance, $total);

                    // Kiểm tra kết quả và hiển thị thông báo tương ứng
                    if ($result) {
                        $success_message = "Dữ liệu đã được nhập thành công từ tệp Excel.";
                    } else {
                        $error_message = "Có lỗi xảy ra trong quá trình nhập dữ liệu.";
                    }
                }
            }

            $redirect_url = "/admin/index.php?page=listSalary";
        }else{
            $error_message = "thêm không thành công";
            $redirect_url = "/admin/index.php?page=listSalary";
        }
    }else{
        $error_message = "Không tìm tháy file";
        $redirect_url = "/admin/index.php?page=listSalary";
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
