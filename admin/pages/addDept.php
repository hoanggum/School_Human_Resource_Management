<style>
    .form-container {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
        background-color: white;
    }
</style>

<div class="container mt-5">
    <div class="form-container">
        <h2 class="mb-4">Thêm phòng ban</h2>
        <hr>
        <form action="?page=processDept" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="deptName" class="form-label">Tên phòng ban</label>
                <input type="text" class="form-control" id="deptName" name="deptName" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Địa chỉ phòng ban</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<script>
        document.getElementById("deptName").focus();
</script>


