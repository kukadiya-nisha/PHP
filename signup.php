<?php include 'header.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php'); ?>


<script>
    $(document).ready(function() {
        $('#email').on('blur', function() {
            var email = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'check_duplicate_Email.php',
                data: {
                    email: email
                },
                success: function(response) {
                    if (response == 'true') {
                        $('#emailError').text('Email already registered.').show();
                        $('#email').addClass('is-invalid');
                    } else {
                        $('#emailError').text('').hide();
                        $('#email').removeClass('is-invalid');
                    }
                }
            });
        });
    });
</script>

<div class="container py-5">
    <div class="card signup-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Create Account</h2>
            <p class="text-muted text-center mb-4">Join us today and start exploring!</p>

            <form action="signup.php" method="post" id="signupForm" enctype="multipart/form-data">
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
                    <label for="mobile" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile Number" name="mobile" data-validation="required numeric min max" data-min="10" data-max="10">
                    <div class="error" id="mobileError"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create password" data-validation="required strongPassword min max" data-min="8" data-max="25">
                    <div class="error" id="passwordError"></div>
                </div>

                <div class=" mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password"
                        data-validation="required confirmPassword" data-password-id="password">
                    <div class="error" id="confirmPasswordError"></div>
                </div>

                <div class=" mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" placeholder="Confirm password"
                        data-validation="required file filesize" data-filesize="200">
                    <div class="error" id="profile_pictureError"></div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" data-validation="terms">
                    <label class="form-check-label" for="terms">I agree to the Terms & Conditions</label>
                    <div class="error" id="termsError"></div>
                </div>
                <button type="submit" class="btn btn-outline-danger w-100 mb-3" name="signup_btn">Sign Up</button>
                <div class="text-center">
                    <p class="mb-0">Already have an account?
                        <a href="login.php" class="text-danger text-decoration-none">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
if (isset($_POST['signup_btn'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $profile_picture = uniqid() . $_FILES['profile_picture']['name'];
    $terms = $_POST['terms'];
    $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
    $token = time();

    $insert = "INSERT INTO `registration`(`firstname`, `lastname`, `email`, `mobile`, `password`, `profile_picture`, `role`, `status`,`token`) VALUES ('$firstName','$lastName','$email','$mobile','$password','$profile_picture','User','Inactive','$token')";
    echo $insert;
    if ($con->query($insert)) {
        if (!file_exists('images/profile_pictures')) {
            mkdir('images/profile_pictures');
        }
        move_uploaded_file($profile_picture_tmp_name, 'images/profile_pictures/' . $profile_picture);
        $mail = new PHPMailer();
        $headers = 'X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $token = date('Y-m-d H:i:s');
        $token = uniqid() . time();
        $to = $email;
        $subject = "Account Verification Link";
        $link = 'http://localhost/php-1/verify.php?email=' . $email . '&token=' . $token;
        $body = "<div style='background-color: #f8f9fa; padding: 20px; border-radius: 5px;'>
                    <h2 style='color: #dc3545; text-align: center;'>Account Verification</h2>
                    <p style='text-align: center;'>Click on the button below to verify your account</p>
                    <a href='" . $link . "' style='display: block; width: 200px; margin: 0 auto; text-align: center; background-color: #dc3545; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Verify Account</a>
                </div>";
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPDebug  = 2;                // enables SMTP debug information (for testing)
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "kansagrajanki@gmail.com";  // GMAIL username(from)
        $mail->Password   = "password";            // GMAIL password(from)
        $mail->SetFrom('kansagrajanki@gmail.com', 'Student Demo Website'); //from
        $mail->AddReplyTo("kansagrajanki@gmail.com", "Student Demo Website"); //to
        $mail->Subject    = "Account Verification Link";
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
        $mail->MsgHTML($body);

        $mail->AddAddress($to, "Student Sample Website");
        if (!$mail->Send()) {
            setcookie('error', 'Failed to send the registration link', time() + 5);
        } else {
            setcookie('success', 'Registration Successfull. Account verification link has been sent to your email. Verify your email to login.', time() + 5);
        }                 // 1 = errors and messages
        // setcookie('success', 'Registration Successful', time() + 5);
    } else {
        setcookie('error', 'Registration Failed', time() + 5);
    }
?>
    <script>
        window.location.href = 'signup.php';
    </script>
<?php
}
?>
