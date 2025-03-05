<?php include 'header.php'; ?>
<div class="container py-5">
    <h2 class="text-center mb-5">Contact Us</h2>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 contact-card">
                <div class="card-body text-center">
                    <i class="bi bi-geo-alt contact-icon mb-3"></i>
                    <h5 class="card-title">Our Location</h5>
                    <p class="card-text">RK University, Rajkot - 360020</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 contact-card">
                <div class="card-body text-center">
                    <i class="bi bi-envelope contact-icon mb-3"></i>
                    <h5 class="card-title">Email Us</h5>
                    <p class="card-text">nisha.kukadiya@rku.ac.in</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 contact-card">
                <div class="card-body text-center">
                    <i class="bi bi-telephone contact-icon mb-3"></i>
                    <h5 class="card-title">Call Us</h5>
                    <p class="card-text">+91 1234567890</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="ratio ratio-4x3" style="height: 100%;">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1659942574455!5m2!1sen!2s"
                    class="border rounded" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Send us a Message</h5>
                    <form id="contactForm">
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

                        <button type="submit" class="btn btn-outline-danger w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>