 <?php 
 require_once('header.php');
?>
 <!-- Responsive Slider (Carousel) -->
 <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Slides -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./images/s1.jpg" class="d-block w-100" alt="Slide 1" height="550px">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First Slide</h5>
                    <p>This is the first slide of the carousel.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/s2.jpg" class="d-block w-100" alt="Slide 2" height="550px">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second Slide</h5>
                    <p>This is the second slide of the carousel.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./images/s3.avif" class="d-block w-100" alt="Slide 3" height="550px">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third Slide</h5>
                    <p>This is the third slide of the carousel.</p>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php
require_once('footer.php');
?>