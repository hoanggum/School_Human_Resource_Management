<?php
// Import controller
include_once '../Controller/LeaveApplicationSheetController.php';

$controller = new LeaveApplicationSheetController();

$action = isset($_GET['action']) ? $_GET['action'] : '';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include file autoload.php của PHPMailer
require '../vendor/autoload.php';

// Hàm gửi email
function sendEmail($to, $subject, $body) {
    // Tạo đối tượng PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'novelnest977@gmail.com';
        $mail->Password = 'vbuv dzdj ksvh qovp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587 ;

        // Thiết lập địa chỉ email gửi và tên người gửi
        $mail->setFrom('novelnest977@gmail.com', ' Novelnest');

        // Thêm địa chỉ email nhận
        $mail->addAddress($to);

        // Thiết lập tiêu đề email
        $mail->Subject = $subject;

        // Thiết lập nội dung email
        $mail->Body = $body;

        // Gửi email
        $mail->send();
        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($action === 'confirm' || $action === 'cancel') {
    $LSheetID = isset($_GET['LSheetID']) ? $_GET['LSheetID'] : '';
    $newStatus = ($action === 'confirm') ? 'Confirmed' : 'Cancelled';
    
    // Gửi email

    $leaveSheetData = $controller->getLeaveApplicationSheetById($LSheetID);
    $recipientEmail = $leaveSheetData[0]['Email'];
    echo $recipientEmail;
    $startDate = date('d/m/Y', strtotime($leaveSheetData[0]['StartDate']));
    $endDate = date('d/m/Y', strtotime($leaveSheetData[0]['EndDate']));
    $currentDate = date('d/m/Y');
    $subject = ($action === 'confirm') ? 'Your leave application has been approved' : 'Your leave application has been cancelled';    $body = "Kính gửi {$leaveSheetData[0]['FullName']},\n\n";
    $body .= "Ngày: {$currentDate}\n\n";
    $body .= "Chúng tôi xin thông báo rằng đơn xin nghỉ phép của bạn với mã số DXP00{$LSheetID} đã được {$newStatus}.\n";
    $body .= "Ngày bắt đầu nghỉ: {$startDate}\n";
    $body .= "Ngày kết thúc nghỉ: {$endDate}\n";
    $body .= "Cảm ơn bạn.\n\n";
    $body .= "Trân trọng,\n";
    $body .= "[Novelnest]\n";
    $body .= "[140 Lê trọng tấn]";
    
    sendEmail($recipientEmail, $subject, $body);

    // Cập nhật trạng thái của đơn nghỉ phép
    $result = $controller->confirmLeaveApplicationSheet($LSheetID, $newStatus);

    if ($result) {
        $success_message = "Leave application sheet has been processed successfully";
        $redirect_url = "/admin/index.php?page=managerLeaveApplicationSheet";
    } else {
        $error_message = "Failed to process leave application sheet";
    }
} else {
    // Nếu không có hành động được chỉ định hoặc hành động không hợp lệ
    $error_message = "Invalid action";
    $redirect_url = "/admin/index.php?page=managerLeaveApplicationSheet";
}

echo "<script>";
if (isset($success_message)) {
    echo "alert('$success_message');";
}
if (isset($error_message)) {
    echo "alert('$error_message');";
}
// echo "window.location='$redirect_url';";
echo "</script>";
exit();

?>
