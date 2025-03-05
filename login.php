<?php include 'header.php'; ?>

<style>

</style>

<div class="container py-5">
    <div class="card login-card">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4">Login</h3>

            <form action="test.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" data-validation="required email">
                    <div class="error" id="emailError"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" data-validation="required" name="password">
                    <div class="error" id="passwordError"></div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-outline-danger w-100 mb-3">Login</button>
            </form>
            <div class="text-center mb-3">
                <a href="forgot_password.php" class="text-danger text-decoration-none">Forgot password?</a>
            </div>
            <div class="text-center">
                <p class="mb-0">Don't have an account?
                    <a href="signup.php" class="text-danger text-decoration-none">Sign up</a>
                </p>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>