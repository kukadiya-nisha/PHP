<?php include 'header.php';
$contact_data = "select * from contact_us";
$contact_result = mysqli_fetch_assoc(mysqli_query($con, $contact_data));
?>
<div class="container py-5">
    <h2 class="text-center mb-5">Contact Us</h2>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 contact-card">
                <div class="card-body text-center">
                    <i class="bi bi-geo-alt contact-icon mb-3"></i>
                    <h5 class="card-title">Our Location</h5>
                    <p class="card-text"><?php echo $contact_result['address']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 contact-card">
                <div class="card-body text-center">
                    <i class="bi bi-envelope contact-icon mb-3"></i>
                    <h5 class="card-title">Email Us</h5>
                    <p class="card-text"><?php echo $contact_result['email']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 contact-card">
                <div class="card-body text-center">
                    <i class="bi bi-telephone contact-icon mb-3"></i>
                    <h5 class="card-title">Call Us</h5>
                    <p class="card-text">+91 <?php echo $contact_result['mobile']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="ratio ratio-4x3" style="height: 100%;">

                <?php echo $contact_result['maps']; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Send us a Message</h5>
                    <form id="contactForm" action="contact.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" data-validation="required min max" data-min="3" data-max="30">
                            <div class="error" id="nameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" name="email" data-validation="required email">
                            <div class="error" id="emailError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Your Mobile Number</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile Number" name="mobile" data-validation="required numeric min max" data-min="10" data-max="10">
                            <div class="error" id="mobileError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" name="subject" data-validation="required">
                            <div class="error" id="subjectError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your Message" name="message" data-validation="required"></textarea>
                            <div class="error" id="messageError"></div>
                        </div>

                        <button type="submit" class="btn btn-outline-danger w-100" name="contact_btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php';
if (isset($_POST['contact_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $insert = "INSERT INTO `contact_inquiry`(`name`, `email`, `mobile`, `subject`, `message`) VALUES ('$name','$email',$mobile,'$subject','$message')";

    if ($con->query($insert)) {
        setcookie('success', "We have received your query. We will reach out to you very soon.", time() + 5, "/");
    } else {
        setcookie('error', "Failed to send the query. Please try again later.", time() + 5, "/");
    }
?>
    <script>
        window.location.href = 'contact.php';
    </script>
<?php
}
?>