<?php
include_once '../Controller/LeaveApplicationSheetController.php';

// Kiểm tra xem phương thức yêu cầu có phải là POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $type = $_POST['leaveType'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $reason = $_POST['reason'];
    
    // Lấy thông tin người dùng từ session (giả sử đã đăng nhập)
    $userID = $_SESSION['UserID'];

    // Khởi tạo controller
    $leaveAppSheetController = new LeaveApplicationSheetController();

    // Thực hiện thêm đơn xin nghỉ phép
    $result = $leaveAppSheetController->addLeaveApplicationSheet($type, $startDate, $endDate, $reason, $userID);
    if ($result) {
        // Nếu thành công, hiển thị thông báo và chuyển hướng người dùng đến trang danh sách đơn xin nghỉ phép
        $success_message = "Đơn xin nghỉ phép đã được gửi thành công";
        $redirect_url = "/user/index.php?page=leave-request";
    } else {
        // Nếu thất bại, hiển thị thông báo lỗi
        $error_message = "Gửi đơn xin nghỉ phép thất bại. Vui lòng thử lại.";
    }
} else {
    // Nếu không phải là phương thức POST, hiển thị thông báo lỗi và kết thúc
    $error_message = "Gửi đơn xin nghỉ phép thất bại. Vui lòng thử lại.";

    exit;
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

