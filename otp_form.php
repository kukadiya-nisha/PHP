<?php include 'header.php'; ?>

<style>

</style>

<div class="container py-5">
    <div class="card otp-card">
        <div class="card-body p-4">
            <h2 class="text-center mb-4">Enter OTP</h2>
            <p class="text-muted text-center mb-4">Please enter the verification code sent to your email</p>

            <form action="otp_form.php" method="post">
                <div class="d-flex justify-content-center mb-4" name="otp">
                    <input type=" text" class="form-control otp-input" maxlength="1" autofocus oninput="moveToNext(this, 0)" name="otp1">

                    <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 1)" name="otp2">

                    <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 2)" name="otp3">
                    <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 3)" name="otp4">
                    <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 4)" name="otp5">
                    <input type="text" class="form-control otp-input" maxlength="1" oninput="moveToNext(this, 5)" name="otp6">
                </div>
                <div class="error" id="otpError"></div>

                <div id="timer" class="text-danger"></div>
                <br>
                <div class="d-flex justify-content-center mb-4" name="otp">
                    <button type="button" id="resend_otp" class="btn text-white w-100" style="display:none;background-color:  #dc3545;">Resend OTP
                    </button>
                </div>
                <script>
                    let timeLeft = 10; // 1 minute timer
                    const timerDisplay = document.getElementById('timer');
                    const resendButton = document.getElementById('resend_otp');


                    // Function to start the countdown
                    function startCountdown() {
                        const countdown = setInterval(() => {
                            if (timeLeft <= 0) {
                                clearInterval(countdown);
                                timerDisplay.innerHTML = "You can now resend the OTP.";
                                resendButton.style.display = "inline";
                                timeLeft = 10;
                            } else {
                                timerDisplay.innerHTML = `Resend OTP in ${timeLeft} seconds`;
                            }
                            timeLeft -= 1;
                        }, 1000);
                    }

                    // Check if there's a remaining time in sessionStorage
                    if (sessionStorage.getItem('otpTimer')) {
                        timeLeft = parseInt(sessionStorage.getItem('otpTimer'));
                        startCountdown();
                    } else {
                        startCountdown();
                    }

                    // Update sessionStorage every second
                    setInterval(() => {
                        sessionStorage.setItem('otpTimer', timeLeft);
                    }, 1000);

                    resendButton.onclick = function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        window.location.href = 'resend_otp_forgot_password.php';
                    };
                </script>
                <button type="submit" class="btn btn-outline-danger w-100 mb-3" name="otp_btn">Verify OTP</button>
            </form>


            <div class="text-center">
                <a href="login.php" class="text-danger text-decoration-none">Back to Login</a>
            </div>

        </div>
    </div>
</div>

<script>
    function moveToNext(input, index) {
        if (input.value.length === input.maxLength) {
            if (index < 5) {
                input.parentElement.children[index + 1].focus();
            }
        }
    }
</script>

<?php include 'footer.php';
if (isset($_POST['otp_btn'])) {

    if (isset($_SESSION['forgot_email'])) {
        $email = $_SESSION['forgot_email'];
        $otp1 = $_POST['otp1'];
        $otp2 = $_POST['otp2'];
        $otp3 = $_POST['otp3'];
        $otp4 = $_POST['otp4'];
        $otp5 = $_POST['otp5'];
        $otp6 = $_POST['otp6'];

        $otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
        echo $otp;

        // Fetch the OTP from the database for the given email
        $query = "SELECT otp FROM password_token WHERE email = '$email' ";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $db_otp = $row['otp'];

            // Compare the OTPs
            if ($otp == $db_otp) {
                // Redirect to new password page
?>
                <script>
                    window.location.href = 'reset_password.php';
                </script>
            <?php

            } else {
                setcookie('error', 'Incorrect OTP', time() + 5, '/');
            ?>

                <script>
                    window.location.href = 'otp_form.php';
                </script>
            <?php
            }
        } else {
            setcookie('error', 'OTP has expired. Regenerate New OTP', time() + 5, '/');
            ?>
            <script>
                window.location.href = 'forgot_password.php';
            </script>
<?php
        }
    }
}
?>