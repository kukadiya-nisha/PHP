<?php include 'header.php'; ?>

<style>
   
</style>

<div class="container py-5">
    <div class="card forgot-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Forgot Password</h2>
            <p class="text-muted text-center mb-4">Enter your email address and we'll send you instructions to reset your password.</p>

            <form action="otp.php">
                <div class="mb-4">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>

                <button type="submit" class="btn btn-outline-danger w-100 mb-3">Reset Password</button>
                
                <div class="text-center">
                    <a href="login.php" class="text-danger text-decoration-none">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
