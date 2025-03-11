<?php include 'admin_header.php';
$email = $_SESSION['admin'];
// echo $email;
$q = "select * from registration where email='$email'";
$result = $con->query($q);
$row = mysqli_fetch_assoc($result);
?>



<div class="container py-5">
    <div class="card profile-card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="images/profile_pictures/<?php echo $row['profile_picture']; ?>" alt="Profile Picture" class="profile-image mb-3">
                <h2 class="mb-1"><?php echo $row['firstname'] . " " . $row['lastname'];  ?></h2>
                <p class="text-muted"><?php echo $row['email']; ?></p>
            </div>

            <form method="post" action="admin_profile.php" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="<?php echo $row['firstname']; ?>" data-validation="required alpha" name="firstName">
                        <div id="firstNameError" class="error"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="<?php echo $row['lastname']; ?>" data-validation="required alpha" name="lastName">
                        <div id="lastNameError" class="error"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" value="<?php echo $row['mobile']; ?>" data-validation="required numeric min max" name="mobile" data-min="10" data-max="10">
                    <div id="mobileError" class="error"></div>
                </div>
                <div class=" mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" placeholder="Confirm password"
                        data-validation="file filesize" data-filesize="200">
                    <div class="error" id="profile_pictureError"></div>
                </div>


                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-danger me-md-2" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger" name="update_btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
 include 'admin_footer.php';
if (isset($_POST['update_btn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_SESSION['admin'];
    $mobile = $_POST['mobile'];

    if ($_FILES['profile_picture']['name'] != "") {
        $profile_picture = uniqid() . $_FILES['profile_picture']['name'];
        $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
    }

    $q1 = "select * from registration where email='$email'";
    $result = mysqli_fetch_assoc($con->query($q1));
    $old_profile_picture = $result['profile_picture'];

    $update = "UPDATE `registration` SET `firstname`='$firstName',`lastname`='$lastName',`mobile`=$mobile";
    if ($_FILES['profile_picture']['name'] != "") {
        $update = $update . ", `profile_picture`='$profile_picture'";
    }
    $update = $update . " where email='$email'";

    // echo $update;

    if ($con->query($update)) {
        if ($_FILES['profile_picture']['name'] != "") {
            move_uploaded_file($profile_picture_tmp_name, "images/profile_pictures/" . $profile_picture);
            unlink("images/profile_pictures/" . $old_profile_picture);
        }
        setcookie('success', 'profile updated successfully', time() + 5, "/");
    } else {
        setcookie('error', 'error in updating profile', time() + 5, "/");
    }

?>
    <script>
        window.location.href = "admin_profile.php";
    </script>
<?php
}
?>