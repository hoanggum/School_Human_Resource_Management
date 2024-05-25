<?php
// Include necessary files
include_once '../Controller/RateController.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
require '../vendor/autoload.php'; // Ensure the path is correct

// Create an instance of RateController
$rateController = new RateController();

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
        $mail->setFrom('novelnest977@gmail.com', 'Novelnest');

        // Thêm địa chỉ email nhận
        $mail->addAddress($to);

        // Thiết lập tiêu đề email và nội dung
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;

        // Gửi email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['submit'])) {
    $userID = $_POST['Employee'];
    $date = $_POST['Date'];
    $reason = $_POST['Reason'];
    $classifil = 'Khen thưởng';

    // Call the method to add the reward entry
    $result = $rateController->addRate($classifil, $date, $reason, $userID);

    if ($result) {
        $success_message = "Reward has been added successfully";
        $redirect_url = "/admin/index.php?page=listReward";

        // Lấy thông tin khen thưởng và người dùng
        $rateId = $rateController->getLastInsertedId(); // Giả sử bạn có hàm để lấy ID khen thưởng vừa thêm
        $rateData = $rateController->getRateById($rateId);
        
        $email = $rateData[0]['Email'];
        $fullName = $rateData[0]['FullName'];

        // Gửi email
        $emailSubject = 'Recognition Notice';
        $emailBody = "Kính gửi {$fullName},<br><br>
                    Chúng tôi xin thông báo rằng bạn đã được khen thưởng với lý do: {$reason}.<br>
                    Ngày khen thưởng: {$date}.<br><br>
                    Cảm ơn bạn đã có những đóng góp xuất sắc.<br><br>
                    Trân trọng,<br>
                    [Novelnest]";

        $emailResult = sendEmail($email, $emailSubject, $emailBody);
        if (!$emailResult) {
            $error_message = "Failed to send reward email.";
        }
    } else {
        $error_message = "Failed to add Reward. Please try again.";
    }
}

echo "<script>";
if (isset($success_message)) {
    echo "alert('$success_message');";
}
if (isset($error_message)) {
    echo "alert('$error_message');";
}
if (isset($redirect_url)) {
    echo "window.location='$redirect_url';";
}
echo "</script>";
?>
