<?php
    include_once '../Controller/UserController.php';

    $userController = new UserController();
    
    $users = $userController->getAllUser();
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
        input#workPlace {
            border: 1px solid #ced4da; /* Định dạng viền */
            border-radius: 5px; /* Định dạng góc cong của viền */
            padding: 5px; /* Định dạng khoảng cách bên trong input */
        }  
    </style>
<div class="container mt-5">
        <div class="form-container">
            <h2 class="mb-4">Tạo Lịch Công Tác</h2>
            <hr>
            <form action="?page=processSchedule" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="userID">Nhân viên:</label>
                    <select class="form-control" id="userID" name="userID" required>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['UserID']; ?>"><?php echo $user['FullName']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="startDate">Ngày bắt đầu:</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                </div>
                <div class="form-group">
                    <label for="endDate">Ngày kết thúc:</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                </div>
                <div class="form-group">
                    <label for="workPlace">Địa điểm làm việc:</label>
                    <input type="text" class="form-control" id="workPlace" name="workPlace" required>
                </div>
                <div class="form-group">
                    <label for="descriptions">Mô tả:</label>
                    <textarea class="form-control" id="descriptions" name="descriptions" rows="4" required></textarea>
                </div>
                
                <button type="submit" name="submit" class="btn btn-dark" style="width: 100%;height:40px;font-size: 13px;margin-top: 10px;">Thêm Lịch Công Tác</button>
            </form>
        </div>
</div>
<script>
        document.getElementById("userID").focus();
</script>  
<script>
        // Initialize datepicker
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });       
</script>                         