<?php
include 'header.php';
include 'user_check_authentication.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $email = $_SESSION['user'];
    $check_query = "select * from wishlist where product_id = '$id' and email = '$email'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        setcookie('error', 'Product already in wishlist.', time() + 3);
?>
        <script>
            window.location.href = "user_wishlist.php";
            // exit();
        </script>
        <?php
    } else {
        $query = "insert into wishlist (product_id, email) values ('$id', '$email')";
        if (mysqli_query($con, $query)) {
            setcookie('success', 'Product added to wishlist successfully', time() + 3);
        ?>
            <script>
                window.location.href = "user_wishlist.php";
                // exit();
            </script>
        <?php
        } else {
            setcookie('error', 'Error in adding product to wishlist.', time() + 3);
        ?>
            <script>
                window.location.href = "user_wishlist.php";
                // exit();
            </script>
<?php
        }
    }
}
