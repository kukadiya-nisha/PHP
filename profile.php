<?php include 'header.php';
include_once('user_check_authentication.php');
?>



<div class="container py-5">
    <div class="card profile-card">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="./images/pngtree-avatar-bussinesman-man-profile-icon-vector-illustration-png-image_7268049.png" alt="Profile Picture" class="profile-image mb-3">
                <h2 class="mb-1">Nisha Kukadiya</h2>
                <p class="text-muted">nisha.kukadiya@rku.ac.in</p>
            </div>

            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" value="Nisha">
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" value="Kukadiya">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" value="nisha.kukadiya@rku.ac.in">
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-danger me-md-2" onclick="window.history.back();">Cancel</button>
                    <button type="submit" class="btn btn-outline-danger">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>