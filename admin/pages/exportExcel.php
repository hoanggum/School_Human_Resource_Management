<style>
    .message-container {
        text-align: center;
        margin-top: 20px;
    }

    .message {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .download-link {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .download-link:hover {
        background-color: #0056b3;
    }
</style>
<?php
include_once '../Controller/UserController.php';
require '../vendor/autoload.php'; // Assuming you are using Composer and PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$userController = new UserController();
$employees = $userController->getAllEmployee();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header row values
$sheet->setCellValue('A1', 'Họ và tên');
$sheet->setCellValue('B1', 'Ngày sinh');
$sheet->setCellValue('C1', 'Giới tính');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Địa chỉ');
$sheet->setCellValue('F1', 'Số điện thoại');
$sheet->setCellValue('G1', 'Tên đăng nhập');
$sheet->setCellValue('H1', 'Mật khẩu');
$sheet->setCellValue('I1', 'ID chức vụ');
$sheet->setCellValue('J1', 'ID phòng ban');
$sheet->setCellValue('K1', 'Trạng thái');

// Add employee data to the spreadsheet
$rowNum = 2;
foreach ($employees as $employee) {
    $sheet->setCellValue('A' . $rowNum, $employee['FullName']);
    $sheet->setCellValue('B' . $rowNum, $employee['Birthday']);
    $sheet->setCellValue('C' . $rowNum, $employee['Gender']);
    $sheet->setCellValue('D' . $rowNum, $employee['Email']);
    $sheet->setCellValue('E' . $rowNum, $employee['Address']);
    $sheet->setCellValue('F' . $rowNum, $employee['Phone']);
    $sheet->setCellValue('G' . $rowNum, $employee['Username']);
    $sheet->setCellValue('H' . $rowNum, $employee['Password']);
    $sheet->setCellValue('I' . $rowNum, $employee['PositionID']);
    $sheet->setCellValue('J' . $rowNum, $employee['DeptID']);
    $sheet->setCellValue('K' . $rowNum, $employee['Status']);
    $rowNum++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'employee_data.xlsx';
$filepath = '../Data' . $filename; // Change this path to the desired save location on your server

// Save the file to the server
$writer->save($filepath);

// Provide a link for the user to download the file

?>
<div class="message-container">
    <div class="message">File has been saved.</div>
    <a class="download-link" href="<?php echo $filepath; ?>">Download here</a>
</div>
