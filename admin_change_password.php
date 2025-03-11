<?php include 'admin_header.php'; ?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Change Password</h3>
                    <form action="admin_change_password.php" method="POST">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password" data-validation="required">
                            <div class="error" id="current_passwordError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" data-validation="required strongPassword min max" data-min="8" data-max="25">

                            <div class="error" id="new_passwordError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" data-validation="required confirmPassword" data-password-id="newPassword">
                            <div class="error" id="confirm_passwordError"></div>
                        </div>
                        <button type="submit" class="btn btn-outline-danger w-100 btn-change-password" name="change_pwd_btn">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'admin_footer.php';

if (isset($_POST['change_pwd_btn'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $email = $_SESSION['admin'];
    // Code to update password in the database here
    $q = "select * from registration where email= '$email'";
    $result = $con->query($q);
    $row = mysqli_fetch_assoc($result);
    if ($current_password == $row['password']) {
        $update = "UPDATE registration SET password='$new_password' WHERE email='$email'";
        if ($con->query($update)) {
            setcookie('success', 'Password updated successfully', time() + 5);
        } else {
            setcookie('error', 'Error in updating password', time() + 5);
        }
    } else {
        setcookie('error', 'Current password is incorrect', time() + 5);
    }
?>
    <script>
        window.location.href = "admin_profile.php";
    </script>
<?php
}
