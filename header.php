<?php
session_start();
ob_start();

include_once("db_connect.php");
include_once("mailer.php");
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");
// $delete_query = "DELETE FROM password_token WHERE expires_at < '$current_time'";
// $con->query($delete_query);
$q = "UPDATE password_token 
SET otp_attempts = 0 
WHERE TIMESTAMPDIFF(HOUR, last_resend, NOW()) >= 24";
$con->query($q);
$remove_otp = "update password_token set otp=NULL WHERE expires_at < '$current_time'";
$con->query($remove_otp);


//offers

$current_time = date("Y-m-d H:i:s");
$query = "UPDATE offers SET status='Inactive' WHERE NOT ('$current_time' BETWEEN start_date AND end_date)";

mysqli_query($con, $query);
$query = "UPDATE offers SET status='Active' WHERE ('$current_time' BETWEEN start_date AND end_date)";

mysqli_query($con, $query);
?>

<html>

<head>
    <!-- <meta http-equiv="refresh" content="121"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-icons.css">

    <script src="css/bootstrap.bundle.min.js"></script>
    <script src="css/jquery-3.6.0.min.js"></script>
    <script src="css/jquery.validate.min.js"></script>
    <script src="css/additional-methods.min.js"></script>
    <script src="jquery/validation.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    // Include the database connection file
    include_once 'config.php';
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">E-Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="all_products.php" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $select = "select * from categories where category_status='active'";
                            $table = mysqli_query($con, $select);
                            while ($row = $table->fetch_assoc()) {
                            ?>
                                <li>
                                    <a class="dropdown-item" href="all_products.php?category=<?php echo $row['id']; ?>"><?= $row['category_name'] ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="all_products.php">All Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="deals.php">Deals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="contact.php">Contact</a>
                    </li>
                </ul>
                <form class="d-flex mb-2 mb-lg-0 mx-2" action="all_products.php">
                    <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <div class="d-flex mx-2">
                        <a href="view_cart.php" class="btn btn-outline-light me-2">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i> Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="user_profile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="user_orders.php">My Orders</a></li>
                            <li><a class="dropdown-item" href="user_wishlist.php">Wishlist</a></li>
                            <li><a class="dropdown-item" href="user_change_password.php">Change Password</a></li>
                            <li><a class="dropdown-item" href="user_logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php
                } else {


                ?>
                    <div class="d-flex mx-2">
                        <a href="login.php" class="btn btn-outline-light me-2">
                            <i class="bi bi-person"></i> Login
                        </a>
                        <a href="signup.php" class="btn btn-outline-light">
                            <i class="bi bi-person"></i> Register
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
    </nav>
    <br>
    <div class="container">
        <?php
        if (isset($_COOKIE['success'])) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?php echo " " . $_COOKIE['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        if (isset($_COOKIE['error'])) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong><?php echo " " . $_COOKIE['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
    </div>