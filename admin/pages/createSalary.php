<?php
    include_once '../Controller/UserController.php';

    $userController = new UserController();
    
    $employees = $userController->getAllUser();
?>
<style>
        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            background-color: white;
        }
        .form-control,
        .form-select {
            font-size: 16px; /* Điều chỉnh kích thước chữ ở đây */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="col-md-15" id="importFrm" style="display: block;">
            <form class="row g-3" action="?page=importSalaryData" method="post" enctype="multipart/form-data">
                <div class="col-auto">
                    <label for="fileInput" class="visually-hidden">File</label>
                    <input type="file" class="form-control" name="file" id="fileInput" style="height: 34px;" />
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark" style="height: 34px;" name="importSubmit">
                        <i class="fas fa-check"></i> Submit
                    </button>
                </div>
            </form>
        </div>

        <div class="form-container">
            <h2 class="mb-4">Form tính lương</h2>
            <hr>
            <form action="?page=processSalary" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="employee" class="form-label">Chọn nhân viên</label>
                <select class="form-select" id="employee" name="employee" required>
                    <option value="">Chọn nhân viên</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo $employee['UserID']; ?>"><?php echo $employee['FullName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Ngày chốt lương</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="basic" class="form-label">Lương cơ bản</label>
                <input type="number" class="form-control" id="basic" name="basic" onchange="calculateTotal()" required>
            </div>
            <div class="mb-3">
                <label for="WorkedDay" class="form-label">Số ngày công</label>
                <input type="number" class="form-control" id="workedDay" name="workedDay" onchange="calculateTotal()" required>
            </div>
            <div class="mb-3">
                <label for="AuthorizedAbsences" class="form-label">Số ngày nghỉ phép</label>
                <input type="number" class="form-control" id="authorizedAbsences" name="authorizedAbsences" onchange="calculateTotal()" required>
            </div>  
            <div class="mb-3">
                <label for="UnauthorizedAbsence" class="form-label">Số ngày không phép</label>
                <input type="number" class="form-control" id="unauthorizedAbsence" name="unauthorizedAbsence" onchange="calculateTotal()" required>
            </div> 
            <div class="mb-3">
                <label for="allowance" class="form-label">Phụ cấp</label>
                <input type="number" class="form-control" id="allowance" name="allowance" onchange="calculateTotal()" required>
            </div>
            <div class="mb-3">
                <label for="advance" class="form-label">Lương ứng</label>
                <input type="number" class="form-control" id="advance" name="advance" onchange="calculateTotal()" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Thực lãnh</label>                
                <input type="number" class="form-control" id="total" name="total" readonly>
            </div>
            <button type="submit" name="submit" class="btn btn-dark btn-block" style="width: 100%;padding: auto;height: 40px;" >Submit</button>
            </form>
        </div>
    </div>

 
    <script>
        // Initialize datepicker
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });       
    </script>
    <script>
        function calculateTotal() {
            var basic = parseFloat(document.getElementById('basic').value);
            var workedDay = parseInt(document.getElementById('workedDay').value);
            var authorizedAbsences = parseInt(document.getElementById('authorizedAbsences').value);
            var unauthorizedAbsence = parseInt(document.getElementById('unauthorizedAbsence').value);
            var allowance = parseFloat(document.getElementById('allowance').value);
            var advance = parseFloat(document.getElementById('advance').value);
            var dateInput = document.getElementById('date').value;

            var dateObject = new Date(dateInput);
            var year = dateObject.getFullYear();
            var month = dateObject.getMonth() + 1;
            var numberSunday = countSundaysInMonth(year, month);
            var nextMonth = month + 1;
            var lastDayOfMonth = new Date(year, nextMonth, 0).getDate();
            var salaryDay = basic / (lastDayOfMonth - numberSunday);
            var total = ((salaryDay * workedDay) - (salaryDay * unauthorizedAbsence)) + allowance - advance;
            var workedDay = lastDayOfMonth - numberSunday;
            var totalWorkedDays = workedDay - authorizedAbsences - unauthorizedAbsence;
            // Cập nhật giá trị tổng lương vào trường nhập liệu "Thực lãnh"
            
            document.getElementById('workedDay').value = totalWorkedDays;
            document.getElementById('total').value = total;
        }

        function countSundaysInMonth(year, month) {
            var count = 0;
            for (var day = 1; day <= new Date(year, month, 0).getDate(); day++) {
                var date = new Date(year, month - 1, day);
                if (date.getDay() === 0) {
                    count++;
                }
            }
            return count;
        }


    </script>


</body>
</html>