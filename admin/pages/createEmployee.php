<?php
    include_once '../Controller/DepartmentController.php';

    include_once '../Controller/PositionController.php';

    $positionController = new PositionController();
    $positions = $positionController->getAllPositions();
    $departmentController = new DepartmentController();
    $departments = $departmentController->index();
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
            font-size: 16px;
            border: 1px solid #ccc;
        }
</style>
<div class="container mt-5">

    <div class="form-container">
        <h1 class="my-4">Add Employee</h1>
        <hr>
        <form action="?page=processEmployee" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="fullName" style="border: 1px solid #ccc;" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" class="form-control" id="birthday" name="birthday" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" style="border: 1px solid #ccc;" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" style="border: 1px solid #ccc;" required>
            </div>
            
            

            <div class="form-group">
                <label for="deptID">Department</label>
                <select class="form-control" id="deptID" name="deptID" required>
                    <?php foreach ($departments as $department) : ?>
                        <option value="<?php echo $department['DeptID']; ?>"><?php echo $department['DeptName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="positionID">Position:</label>
                <select class="form-control" id="positionID" name="positionID" required>
                    <?php foreach ($positions as $position): ?>
                        <option value="<?php echo $position['PositionID']; ?>"><?php echo $position['PositionName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Đang làm việc">Đang làm việc</option>
                    <option value="Thực tập">Thực tập</option>
                </select>
            </div>
            <div class="form-group">
                <label for="img">Image:</label>
                <input type="file" class="form-control-file" id="img" name="img">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</div>