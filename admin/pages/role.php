<?php
// Include the RoleController class
include_once '../Controller/RoleController.php';

// Create an instance of the RoleController
$roleController = new RoleController();
include_once '../Controller/UserController.php';

$userController = new UserController();
$listUser = $userController->getUsersByRole('User');
// Get all roles using the getAllRoles method
$roles = $roleController->getAllRoles();
?>

<style>
/* Custom CSS */
.custom-container {
    padding: 20px;
}

.custom-card {
    margin-bottom: 20px;
}
</style>

<div class="container custom-container">
    <h1>Roles</h1>
    <div class="row">
        <?php foreach ($roles as $role): ?>
            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $role['RoleName']; ?></h2>
                        <!-- You can customize this card content as needed -->
                        <p class="card-text">Number <?php echo $role['RoleName']; ?>: <?php echo $userController->countUsersByRole($role['RoleName']); ?></p>
                        <?php if ($role['RoleName'] === 'Admin'): ?>
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selectUserModal">
                                <i class="fas fa-plus"></i> Chọn Người Dùng
                            </a>
                        <?php else: ?>
                            <a href="?page=createEmployee" class="btn btn-success"><i class="fas fa-plus"></i> Thêm Người Dùng</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="selectUserModal" tabindex="-1" aria-labelledby="selectUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectUserModalLabel">Chọn Người Dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="?page=process_select_admin" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="selectedUser" class="form-label">Chọn Người Dùng</label>
                        <select class="form-select" id="selectedUser" name="selectedUser">
                            <?php foreach ($listUser as $user): ?>
                                <option value="<?php echo $user['UserID']; ?>"><?php echo $user['FullName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->


</div>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('selectUserModal'));
</script>

