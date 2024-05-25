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
        .form-control {
            font-size: 16px;
        }
        #Date, #Reason {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 8px;
        }
        .btn-dark {
            width: 100%;
            height: 40px;
            font-size: 13px;
            margin-top: 10px;
        }
    </style>

    <div class="container mt-5">
        <button type="button" class="btn btn-dark" style="width: 6%; height: 8%;" onclick="goBack()">
            <i class="fas fa-arrow-left"></i> <!-- Biểu tượng back -->
        </button>
        <div class="form-container">
            <h2 class="mb-4">Thêm kỹ luật Mới</h2>
            <hr>
            <form method="POST" action="?page=processDiscipline" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="Employee" class="form-label">Chọn nhân viên</label>
                    <select class="form-control" id="Employee" name="Employee">
                        <?php
                            foreach ($users as $user) {
                                echo '<option value="' . $user['UserID'] . '">' . $user['FullName'] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Date" class="form-label">Ngày lập</label>
                    <input type="date" class="form-control" id="Date" name="Date">
                </div>
                <div class="mb-3">
                    <label for="Reason" class="form-label">Nội dung kỹ luật</label>
                    <textarea class="form-control" id="Reason" name="Reason"></textarea>
                </div>               
                <button type="submit" class="btn btn-dark" name="submit">Submit</button>
            </form>
        </div>
    </div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
