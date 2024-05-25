<style>

    .container{
        padding: 25px;
        margin-top: 40px;
        background-color:aliceblue ;
    }

    .btn-primary {
        background-color:darkblue ;
        width: 100%; /* Độ rộng của nút */
    }
</style>
<div class="container">
        <h1 class="text-center mb-3">Đơn xin nghỉ phép</h1>
        <!-- Leave Request Form -->
        <form action="?page=submit_leave_request" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="leaveType" class="form-label">Loại phép</label>
                <select class="form-select" id="leaveType" name="leaveType" required>
                    <option value="Nghỉ bệnh">Nghỉ bệnh</option>
                    <option value="Nghỉ phép năm">Nghỉ phép năm</option>
                    <!-- Add other leave types as needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="startDate" name="startDate" required>
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="endDate" name="endDate" required>
            </div>
            <div class="mb-3">
                <label for="reason" class="form-label">Lí do</label>
                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>