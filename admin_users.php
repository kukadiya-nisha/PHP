<?php
include 'admin_header.php';
$limit = 5; // Number of users per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Handling Add User
if (isset($_POST['add_user'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $token = uniqid() . time();

    // Handle file upload
    $target_dir = "images/profile_pictures/";
    $file_extension = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    $new_filename = uniqid() . $_FILES["profile_picture"]["name"];
    $target_file = $target_dir . $new_filename;

    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $insert = "INSERT INTO registration (firstname, lastname, email, mobile, password, role, status, profile_picture,token) 
                  VALUES ('$firstname', '$lastname', '$email', '$mobile', '$password', '$role', '$status', '$new_filename','$token')";

        $result = mysqli_query($con, $insert);
        if ($result) {
            echo "<script>alert('User Added Successfully');</script>";
            echo "<script>window.location.href='admin_users.php';</script>";
        } else {
            echo "<script>alert('Error Adding User');</script>";
        }
    } else {
        echo "<script>alert('Error Uploading Profile Picture');</script>";
    }
}


// Handling Edit User
if (isset($_POST['edit_user_btn'])) {
    $id = $_POST['edit_id'];
    $firstname = $_POST['edit_firstName'];
    $lastname = $_POST['edit_lastName'];
    $email = $_POST['edit_email'];
    $mobile = $_POST['edit_mobile'];
    $role = $_POST['edit_role'];
    $status = $_POST['edit_status'];
    $password = $_POST['edit_password'];

    // Get current user data
    $get_data = "SELECT * FROM registration WHERE id = $id";
    echo $get_data;
    $result = mysqli_query($con, $get_data);
    $user = mysqli_fetch_assoc($result);

    $target_dir = "images/profile_pictures/";
    $update_query = "UPDATE registration SET 
                    firstname = '$firstname',
                    lastname = '$lastname',
                    email = '$email',
                    mobile = '$mobile',
                    role = '$role',
                    status = '$status',
                    password = '$password'";

    // Handle profile picture upload if new image is selected
    if (!empty($_FILES['edit_profile_picture']['name'])) {
        $old_image = $user['profile_picture'];
        $new_filename = uniqid() . $_FILES["edit_profile_picture"]["name"];
        $target_file = $target_dir . $new_filename;
        $update_query .= ", profile_picture = '$new_filename'";
    }

    $update_query .= " WHERE id = $id";
    echo $update_query;

    if (mysqli_query($con, $update_query)) {
        move_uploaded_file($_FILES["edit_profile_picture"]["tmp_name"], $target_file);
        // Delete old profile picture
        if (file_exists($target_dir . $old_image)) {
            unlink($target_dir . $old_image);
        }
        echo "<script>alert('User updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating user');</script>";
    }
    echo "<script>window.location.href='admin_users.php';</script>";
}

// Handling Delete User
if (isset($_POST['deleteUser'])) {
    $userId = $_POST['id'];

    // Get user's profile picture before deletion
    $result = mysqli_query($con, "SELECT profile_picture FROM registration WHERE id = $userId");
    $user = mysqli_fetch_assoc($result);

    // Delete user from database
    $delete_query = "DELETE FROM registration WHERE id = $userId";
    if (mysqli_query($con, $delete_query)) {
        // Delete profile picture file
        if (!empty($user['profile_picture'])) {
            $target_dir = "images/profile_pictures/";
            if (file_exists($target_dir . $user['profile_picture'])) {
                unlink($target_dir . $user['profile_picture']);
            }
        }
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
    echo "<script>window.location.href='admin_users.php';</script>";
}

// Handling User Status Change
if (isset($_POST['deactivateUser'])) {
    $userId = $_POST['id'];
    $update_query = "UPDATE registration SET status = 'Inactive' WHERE id = $userId";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('User deactivated successfully');</script>";
    } else {
        echo "<script>alert('Error deactivating user');</script>";
    }
    echo "<script>window.location.href='admin_users.php';</script>";
}

if (isset($_POST['activateUser'])) {
    $userId = $_POST['id'];
    $update_query = "UPDATE registration SET status = 'Active' WHERE id = $userId";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('User activated successfully');</script>";
    } else {
        echo "<script>alert('Error activating user');</script>";
    }
    echo "<script>window.location.href='admin_users.php';</script>";
}
?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">User Management</h2>
    </div>

    <div class="card-body">
        <!-- Search and Add User -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <form method="post" action="admin_users.php">
                        <input type="text" class="form-control" placeholder="Search users..." name="search">
                        <button class="btn btn-danger mt-3" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-plus-circle"></i> Add New User
                </button>
            </div>
        </div>

        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile Picture</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM registration LIMIT $start, $limit";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><img src="images/profile_pictures/<?php echo $row['profile_picture']; ?>" width="50" height="50" class="rounded-circle"></td>
                            <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary viewBtn"
                                    data-id="<?= $row['id'] ?>"
                                    data-firstname="<?= $row['firstname'] ?>"
                                    data-lastname="<?= $row['lastname'] ?>"
                                    data-email="<?= $row['email'] ?>"
                                    data-mobile="<?= $row['mobile'] ?>"
                                    data-role="<?= $row['role'] ?>"
                                    data-status="<?= $row['status'] ?>"
                                    data-password="<?= $row['password'] ?>"
                                    data-profile_picture="<?= $row['profile_picture'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewUserModal">
                                    View
                                </button>
                                <button class="btn btn-sm btn-outline-info me-1 editBtn"
                                    data-id="<?= $row['id'] ?>"
                                    data-firstname="<?= $row['firstname'] ?>"
                                    data-lastname="<?= $row['lastname'] ?>"
                                    data-email="<?= $row['email'] ?>"
                                    data-mobile="<?= $row['mobile'] ?>"
                                    data-role="<?= $row['role'] ?>"
                                    data-status="<?= $row['status'] ?>"
                                    data-profile_picture="<?= $row['profile_picture'] ?>"
                                    data-password="<?= $row['password'] ?>"
                                    data-confirmPassword="<?= $row['password'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal">
                                    Edit
                                </button>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="submit" name="deleteUser" class="btn btn-sm btn-outline-danger" value="Delete">
                                </form>
                                <?php if ($row['status'] == 'Active') { ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="deactivateUser" class="btn btn-sm btn-outline-warning" value="Deactivate">
                                    </form>
                                <?php } else { ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="activateUser" class="btn btn-sm btn-outline-success" value="Activate">
                                    </form>
                                <?php } ?>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php
        $total_query = "SELECT COUNT(*) as total FROM registration";
        $total_result = mysqli_query($con, $total_query);
        $total_rows = mysqli_fetch_assoc($total_result)['total'];
        $totalPages = ceil($total_rows / $limit);
        ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1) { ?>
                    <li class="page-item"><a class="page-link" href="admin_users.php?page=<?= $page - 1 ?>">Previous</a></li>
                <?php }
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? "active" : "") . "'><a class='page-link' href='admin_users.php?page=$i'>$i</a></li>";
                }
                if ($page < $totalPages) { ?>
                    <li class="page-item"><a class="page-link" href="admin_users.php?page=<?= $page + 1 ?>">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
<style>
    .modal-dialog {
        max-width: 800px;
        /* Increased from default 500px */
        width: 70%;
        /* Responsive width */
        margin: 1.75rem auto;
    }
</style>

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="bi bi-person-circle"></i> User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                        <div id="view_profile_picture" class="rounded-circle border shadow-sm" width="150" height="150" alt="Profile Picture">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h4><span id="view_firstname" class="mb-3"></span>
                                    <span id="view_lastname" class="mb-3"></span>
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <strong><i class="bi bi-envelope"></i> Email:</strong> <span id="view_email"></span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong><i class="bi bi-phone"></i> Mobile:</strong> <span id="view_mobile"></span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong><i class="bi bi-shield-lock"></i> Role:</strong> <span id="view_role"></span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong><i class="bi bi-check-circle"></i> Status:</strong> <span id="view_status" class="badge bg-success"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="admin_users.php" method="post" enctype="multipart/form-data" id="addUserForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName"
                                placeholder="Enter first name" data-validation="required alpha">
                            <div class="error" id="firstNameError"></div>

                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                placeholder="Enter last name" data-validation="required alpha">
                            <div class="error" id="lastNameError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                                data-validation="required email">
                            <div class="error" id="emailError"> </div>
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile Number"
                                name="mobile" data-validation="required numeric min max" data-min="10" data-max="10">
                            <div class="error" id="mobileError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Create password" data-validation="required strongPassword min max" data-min="8"
                                data-max="25">
                            <div class="error" id="passwordError"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirm password" data-validation="required confirmPassword"
                                data-password-id="password">
                            <div class="error" id="confirmPasswordError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="role" class="form-label">Select Role</label>
                            <select name="role" id="role" class="form-control" data-validation="required">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <div class="error" id="roleError"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" data-validation="required">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="error" id="statusError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                                placeholder="Confirm password" data-validation="required file filesize" data-filesize="200">
                            <div class="error" id="profile_pictureError"></div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger" name="add_user">Add User</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="admin_users.php" method="post" enctype="multipart/form-data" id="editUserForm">
                    <input type="hidden" id="edit_id" name="edit_id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="edit_firstName" name="edit_firstName"
                                placeholder="Enter first name" data-validation="required alpha">
                            <div class="error" id="edit_firstNameError"></div>

                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="edit_lastName" name="edit_lastName"
                                placeholder="Enter last name" data-validation="required alpha">
                            <div class="error" id="edit_lastNameError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Enter your email"
                                data-validation="required email">
                            <div class="error" id="edit_emailError"> </div>
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="edit_mobile" name="edit_mobile" placeholder="Your Mobile Number"
                                name="mobile" data-validation="required numeric min max" data-min="10" data-max="10">
                            <div class="error" id="edit_mobileError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="edit_password"
                                placeholder="Create password" data-validation="required strongPassword min max" data-min="8"
                                data-max="25">
                            <div class="error" id="edit_passwordError"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="edit_confirmPassword" name="edit_confirmPassword"
                                placeholder="Confirm password" data-validation="required confirmPassword"
                                data-password-id="edit_password">
                            <div class="error" id="edit_confirmPasswordError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="role" class="form-label">Select Role</label>
                            <select name="edit_role" id="edit_role" class="form-control" data-validation="required">
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                            <div class="error" id="edit_roleError"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="edit_status" id="edit_status" class="form-control" data-validation="required">
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <div class="error" id="edit_statusError"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="edit_profile_picture" name="edit_profile_picture"
                                placeholder="Confirm password" data-validation="file filesize" data-filesize="200">
                            <div class="error" id="edit_profile_pictureError"></div>
                        </div>
                        <div id="profilePicturePreview">

                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger" name="edit_user_btn">Update User</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="admin_users.php" method="post" enctype="multipart/form-data" id="addUserForm">
                    <div class="mb-3">
                        <label for="firstname" class="form-label"><b>First Name</b></label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                        <div class="error" id="firstnameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label"><b>Last Name</b></label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                        <div class="error" id="lastnameError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" class="form-control" id="email" name="email">
                        <div class="error" id="emailError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label"><b>Mobile</b></label>
                        <input type="number" class="form-control" id="mobile" name="mobile">
                        <div class="error" id="mobileError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="error" id="passwordError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label"><b>Confirm Password</b></label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                        <div class="error" id="confirmPasswordError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label"><b>Profile Picture</b></label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                        <div class="error" id="profile_pictureError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label"><b>Role</b></label>
                        <select class="form-control" id="role" name="role">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <div class="error" id="roleError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label"><b>Status</b></label>
                        <select class="form-control" id="status" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <div class="error" id="statusError"></div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add_user_btn" class="btn btn-danger">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".editBtn").click(function() {
            var id = $(this).data("id");
            alert(id);
            var firstname = $(this).data("firstname");
            var lastname = $(this).data("lastname");
            var email = $(this).data("email");
            var mobile = $(this).data("mobile");
            var role = $(this).data("role");
            var status = $(this).data("status");
            var profile_picture = $(this).data("profile_picture");
            var password = $(this).data("password");
            var confirmPassword = $(this).data("password");
            if (profile_picture) {
                $('#profilePicturePreview').html('<img src="images/profile_pictures/' + profile_picture + '" width="100" class="rounded">');
            } else {
                $('#profilePicturePreview').html('<p>No Image</p>');
            }
            $("#edit_id").val(id);

            $("#edit_firstName").val(firstname);
            $("#edit_lastName").val(lastname);
            $("#edit_email").val(email);
            $("#edit_mobile").val(mobile);
            $("#edit_role").val(role);
            $("#edit_status").val(status);
            // $("#edit_profile_picture").val(profile_picture_src);
            $("#edit_password").val(password);
            $("#edit_confirmPassword").val(confirmPassword);
            $("#editUserModal").modal("show");
        });

        $(".viewBtn").click(function() {
            var id = $(this).data("id");
            var firstname = $(this).data("firstname");
            var lastname = $(this).data("lastname");
            var email = $(this).data("email");
            var mobile = $(this).data("mobile");
            var role = $(this).data("role");
            var status = $(this).data("status");
            var profile_picture = $(this).data("profile_picture");
            var password = $(this).data("password");

            // $("#view_id").val(id);

            $("#view_firstname").html(firstname);
            $("#view_lastname").html(lastname);
            $("#view_email").html(email);
            $("#view_mobile").html(mobile);
            $("#view_role").html(role);
            $("#view_status").html(status);
            $("#view_password").html(password);

            // alert($('#view_firstname').val());
            // $("#view_profile_picture").val(profile_picture);

            if (profile_picture) {
                $('#view_profile_picture').html('<img src="images/profile_pictures/' + profile_picture + '" width="150" class="rounded" height="150">');
            } else {
                $('#view_profile_picture').html('<p>No Image</p>');
            }
            $("#viewUserModal").modal("show");

        });

    });
</script>

<?php include 'footer.php'; ?>