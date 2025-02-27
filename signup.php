<?php include 'header.php'; ?>

<script>
    // $(document).ready(function() {
    //     $('#email').on('input', function() {
    //         var email = $(this).val();
    //         $.ajax({
    //             type: 'POST',
    //             url: 'checkEmail.php',
    //             data: {email: email},
    //             success: function(response) {
    //                 if(response == 'true') {
    //                     $('#emailError').text('Email already registered.').show();
    //                     $('#email').addClass('is-invalid');
    //                 } else {
    //                     $('#emailError').text('').hide();
    //                     $('#email').removeClass('is-invalid');
    //                 }
    //             }
    //         });
    //     });
    // });
</script>

<div class="container py-5">
    <div class="card signup-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Create Account</h2>
            <p class="text-muted text-center mb-4">Join us today and start exploring!</p>

            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" data-validation="required alpha">
                        <div class="error" id="firstNameError"></div>

                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" data-validation="required alpha">
                        <div class="error" id="lastNameError"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" data-validation="required email">
                    <div class="error" id="emailError"> </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create password" data-validation="required strongPassword">
                    <div class="error" id="passwordError"></div>
                </div>

                <div class=" mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password"
                        data-validation="required confirmPassword" data-password-id="password">
                    <div class="error" id="confirmPasswordError"></div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" data-validation="terms">
                    <label class="form-check-label" for="terms">I agree to the Terms & Conditions</label>
                    <div class="error" id="termsError"></div>
                </div>

                <button type="submit" class="btn btn-outline-danger w-100 mb-3">Sign Up</button>
                <div class="text-center">
                    <p class="mb-0">Already have an account?
                        <a href="login.php" class="text-danger text-decoration-none">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>