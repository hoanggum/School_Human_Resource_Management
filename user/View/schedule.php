<?php
include_once '../Controller/ScheduleController.php';

// Lấy tháng hiện tại từ URL nếu có, nếu không thì sử dụng tháng hiện tại
$currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date("m");
$currentYear = isset($_GET['year']) ? intval($_GET['year']) : date("Y");
if($currentMonth > 12){
  $currentMonth -= 12 ;
  $currentYear++;
}
if($currentMonth < 1){
  $currentMonth += 12 ;
  $currentYear--;
}
// Xử lý nút "Tuần trước"
$userID = $_SESSION['UserID'];
$scheduleController = new ScheduleController();
$scheduleData = $scheduleController->getScheduleOfMonth($userID, $currentMonth,$currentYear);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thời khóa biểu</title>
  <link rel="stylesheet" href="./css/schedule_site.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
  <div class="timetable">
    <div class="row align-items-center justify-content-between mb-4">
        <div class="col-auto">
          <a class="btn btn-primary" href="?page=schedule&month=<?php echo $currentMonth - 1; ?>&year=<?php echo $currentYear; ?>"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="col-auto">
          <h3>Lịch công tác tháng <?php echo $currentMonth?>/<?php echo $currentYear?></h3>
        </div>
        <div class="col-auto">
          <a class="btn btn-primary" href="?page=schedule&month=<?php echo $currentMonth + 1; ?>&year=<?php echo $currentYear; ?>"><i class="fas fa-arrow-right"></i></a>
        </div>
      </div>
      <div class="week">
      <div class="container mt-4 subtitle-container">
        <div class="dropdown mb-4">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Chọn loại lịch
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#" onclick="filterSchedule('all')">Tất cả</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterSchedule('current')">Lịch đang diễn ra</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterSchedule('past')">Lịch đã kết thúc</a></li>
                <li><a class="dropdown-item" href="#" onclick="filterSchedule('future')">Lịch chuẩn bị</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-12 col-md-4">
                <div class="subtitle">
                    <div class="rectangle finished"></div>
                    <div class="text">Lịch đã kết thúc</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="subtitle">
                    <div class="rectangle ongoing"></div>
                    <div class="text">Lịch đang diễn ra</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="subtitle">
                    <div class="rectangle preparing"></div>
                    <div class="text">Lịch chuẩn bị</div>
                </div>
            </div>
        </div>
    </div>
      
        <table class="schedule">
          <tbody id="scheduleBody">
          <?php
            $currentDate = date('Y-m-d');
            if (empty($scheduleData)) {
              echo '<div class="no-schedule">Không có lịch công tác nào cho tháng này.</div>';
            }
            foreach ($scheduleData as $key => $schedule) {
              $startDate =$schedule['StartDate'];
              $endDate = $schedule['EndDate'];
              // Kiểm tra xem lịch đã qua hay chưa dựa trên ngày kết thúc
                if ($endDate < $currentDate) {
                    echo "<div class='employee-item past'>"; // Áp dụng lớp CSS .past
                } elseif($startDate <= $currentDate && $endDate >= $currentDate) {
                        echo "<div class='employee-item priority'>"; // Áp dụng lớp CSS .priority cho lịch gần nhất
                } else {
                        echo "<div class='employee-item'>";
                }
                
                

                echo "<div class='work-place'>" . $schedule['WorkPlace'] . "</div>";
                echo "<div class='date-range'>" . $schedule['StartDate'] . " -> " . $schedule['EndDate'] . "</div>";
                echo "<div class='description'>" . $schedule['Descriptions'] . "</div>";
                echo "</div>";
            }
            ?>

          </tbody>
        </table>
      </div>
    </div>
</body>

</html>
<script>

function filterSchedule(type) {
    $('.employee-item').hide(); // Ẩn tất cả các lịch
    if (type === 'all') {
        $('.employee-item').show(); // Hiển thị tất cả các lịch
        return;
    }
    // Hiện các lịch dựa trên loại được chọn
    else if (type === 'current') {
        $('.employee-item.priority').show(); // Hiện các lịch đang diễn ra
    } else if (type === 'past') {
        $('.employee-item.past').show(); // Hiện các lịch đã kết thúc
    } else if (type === 'future') {
        $('.employee-item:not(.past):not(.priority)').show(); // Hiện các lịch chuẩn bị
    }
}
</script>
