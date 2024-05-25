<?php
if (!isset($_SESSION['UserID'])) {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('Location: login.html');
    exit();
}
include_once '../Controller/UserController.php';

$userController = new UserController();
$employee = $userController->getUserById($_SESSION['UserID']);
// Lấy thông tin cá nhân từ session

?>
<style>
    

    .container {
        max-width: 600px;
        margin: 20px auto;
        display: flex;
        align-items: center;
    }

    img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .info {
        flex-grow: 1;
    }

    h1, h2 {
        margin-top: 0;
    }

    p {
        margin: 5px 0;
    }

</style>
    <div id="account-info" class="box list-box">
    <div class="row justify-content-center">
        <div id="avt" class="account-info-item">
            <td><img class="img" src="../img/<?php echo $employee[0]['ImageURL']; ?>" alt="Hình ảnh nhân viên"></td>
            <button class="edit-avt-btn" id="edit-avt-btn">Choose <i class="fa-regular fa-pen-to-square"></i></button>
        </div>
        <div class="account-info-item text-center">
            <h2 style="font-size: 2.4rem; margin-top: 1rem; margin-bottom: 3rem;"><?php echo $employee[0]['FullName']; ?></h2>
            <h3 style="font-size: 1.9rem; margin-top: 1rem; margin-bottom: 3rem;"><?php echo $employee[0]['Birthday']; ?></h3>

        </div>
    </div>
    <form id="account-info-form" action="?page=save_changes" method="POST" enctype="multipart/form-data">
    <div class="row account-info-content justify-content-center">
        <div id="fullname-box" class="account-info-item">
            <div class="account-info-item-header">
                <section class="account-info-item-title">
                    Full Name
                </section>
                <button class="account-info-edit-btn" onclick="enableEditing('full-name')">
                    Edit
                </button>
            </div>
            <input id="full-name" name="full-name" type="text" value="<?php echo $employee[0]['FullName']; ?>" class="disabled-input">
        </div>
    </div>
    <div class="row account-info-content justify-content-center">
        <div id="username-box" class="account-info-item">
            <div class="account-info-item-header">
                <section class="account-info-item-title">
                    Account
                </section>
                <button class="account-info-edit-btn" onclick="enableEditing('user-name')">
                    Edit
                </button>
            </div>
            <input id="user-name" name="user-name" type="text" value="<?php echo $employee[0]['Username']; ?>" placeholder="#123haha" class="disabled-input" >
        </div>
    </div>
    <div class="row account-info-content justify-content-center">
        <div id="email-box" class="account-info-item">
            <div class="account-info-item-header">
                <section class="account-info-item-title">
                    Email
                </section>
                <button class="account-info-edit-btn" onclick="enableEditing('user-email')">
                    Edit
                </button>
            </div>
            <input id="user-email" name="user-email" type="text" value="<?php echo $employee[0]['Email']; ?>" placeholder="example@gmail.com" class="disabled-input">
        </div>
    </div>
    
    <div class="row account-info-content justify-content-center">
        <div id="phonenumber-box" class="account-info-item">
            <div class="account-info-item-header">
                <section class="account-info-item-title">
                    Phone Number
                </section>
                <button class="account-info-edit-btn" onclick="enableEditing('user-phonenumber')">
                    Edit
                </button>
            </div>
            <?php
                $phoneNumber = $employee[0]['Phone'];
                $hiddenPhoneNumber = substr($phoneNumber, 0, -3) . '***';
            ?>
            <input id="user-phonenumber" name="user-phonenumber" type="tel" value="<?php echo $phoneNumber; ?>" placeholder="012xxxxxxx" class="disabled-input">
        </div>
    </div>
    <div class="row account-info-content justify-content-center">
        <div id="address-box" class="account-info-item">
            <div class="account-info-item-header">
                <section class="account-info-item-title">
                    Address
                </section>
                <button class="account-info-edit-btn" onclick="enableEditing('user-address')"> 
                    Edit
                </button>
            </div>
            <input id="user-address" name="user-address" type="tel" value="<?php echo $employee[0]['Address']; ?>" placeholder="012xxxxxxx" class="disabled-input" >
        </div>
    </div>
    <div class="row account-info-content justify-content-center">
        <!-- còn -->
        <div id="password-box" class="account-info-item">
            <div class="account-info-item-header">
                <section class="account-info-item-title">
                    Password
                </section>
                <button class="account-info-edit-btn" data-bs-toggle="modal" data-bs-target="#passwordModal">
                    Edit
                </button>
            </div>
            <input id="password" name="password" type="password" value="<?php echo $employee[0]['Password']; ?>" placeholder="*********" class="disabled-input" disabled>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="background-color: gray;">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordForm">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" required>
                </div>
                <div class="mb-3">
                    <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmNewPassword" required>
                </div>
                <button type="submit" class="btn btn-dark" style="width: 100%;">Save Changes</button>
                </form>
            </div>
            </div>
        </div>
        </div>

    </div>
    
    
    <div class="row account-info-content justify-content-center" style="margin:0; padding: 0;">
        <div class="col-5" style="margin:0; padding: 0;">
            <div class="line-seperate mt-2"></div>
        </div>
    </div>

    <div class="row account-info-content justify-content-center" style="margin:0; padding: 0; margin-bottom: 2rem;">
        <div id="saving-box" class="account-info-item" style="margin:0; padding: 0;">
            <div id="saving-box" class="account-info-item">
                <button id="save-btn" name="submit" class="save-btn disabled-btn" onclick="submitForm()">Save</button>
            </div>
        </div>
    </div>
    </form>
</div>

<input type="file" id="fileInput" style="display: none;" accept="image/*">


<script>
    function enableEditing(inputId) {
        var input = document.getElementById(inputId);
        input.removeAttribute('disabled');
        input.focus();
    }
    function submitForm() {
        document.getElementById("account-info-form").submit();
    }
    
</script>


