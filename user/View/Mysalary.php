    <?php
    include_once '../Controller/SalaryController.php';

    // Lấy userID từ session hoặc từ các nguồn khác
    $userID = $_SESSION['UserID'];
    $year = date('Y'); // Lấy năm hiện tại
    $currentMonth = isset($_GET['month']) ? intval($_GET['month']) : date("m");
    $selectedMonth = $currentMonth;
    // Tạo đối tượng controller
    $SalaryController = new SalaryController();

    // Gọi hàm để lấy thông tin lương và bảng chấm công của người dùng cho năm hiện tại
    $datas = $SalaryController->getSalaryOfPeople($userID, $year);

    // Xử lý dữ liệu và truyền vào biểu đồ
    $labels = [];
    $data = [];

    foreach ($datas as $row) {
        $labels[] = "Tháng " . date("m", strtotime($row["SDate"]));
        $data[] = $row["Total"];
    }
    ?>

    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Biểu đồ thống kê lương</title>
        <!-- Bootstrap CSS -->
        <!-- Chart.js -->
    </head>
    <body>
        <div class="container">
            <h2 class="text-center mb-4">Biểu đồ thống kê số liệu lương năm <?php echo $year ?></h2>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <canvas id="salaryChart" width="400" height="200"></canvas>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="input-group mb-2">
                    <label for="month" class="input-group-text">Chọn tháng:</label>
                    <select name="month" id="month" class="form-select" onchange="changeMonth()">
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if ($i == $selectedMonth) echo "selected"; ?>>
                                Tháng <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-8">
                    <h2 class="text-center mb-4">Thông tin lương tháng <?php echo $currentMonth ?></h2>

                    <div class="row justify-content-center">
                        <?php foreach ($datas as $salary):  
                            if(date("m", strtotime($salary["SDate"])) == $currentMonth): ?>
                                <div class="col-md-10 mb-6">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h3 class="card-title text-primary "><?php echo $salary['FullName']; ?></h3>
                                            <p class="card-text "><strong>Ngày chốt lương:</strong> <?php echo $salary['SDate']; ?></p>
                                            <p class="card-text "><strong>Lương cơ bản:</strong> <?php echo $salary['Basic'].' VNĐ'; ?></p>
                                            <p class="card-text "><strong>Ngày làm việc:</strong> <?php echo $salary['WorkedDay'].' ngày'; ?></p>
                                            <p class="card-text "><strong>Số ngày nghỉ:</strong> <?php echo $salary['AuthorizedAbsences'].' ngày'; ?></p>
                                            <p class="card-text "><strong>Số ngày không phép:</strong> <?php echo $salary['UnauthorizedAbsences'].' ngày'; ?></p>
                                            <p class="card-text "><strong>Phụ cấp:</strong> <?php echo $salary['Allowance'].' VNĐ'; ?></p>
                                            <p class="card-text "><strong>Lương ứng:</strong> <?php echo $salary['Advance'].' VNĐ'; ?></p>
                                            <p class="card-text " style="font-size: 24px;"><strong>Tổng lương:</strong> <?php echo $salary['Total'].' VNĐ'; ?></p>
                                            <!-- Thêm các thông tin khác của lương nếu cần -->
                                        </div>
                                    </div>
                                </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            
            
            </div>

        </div>

        <script>
            // Dữ liệu lương từ PHP
            const monthlySalaries = {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Lương (triệu VND)',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            // Vẽ biểu đồ
            const ctx = document.getElementById('salaryChart').getContext('2d');
            const salaryChart = new Chart(ctx, {
                type: 'bar',
                data: monthlySalaries,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            function changeMonth() {
                var selectedMonth = document.getElementById("month").value;
                window.location.href = "?page=Mysalary&month=" + selectedMonth;
            }
        </script>
    </body>
    </html>


