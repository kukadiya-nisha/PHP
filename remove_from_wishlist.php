<?php
include "header.php";
include "user_check_authentication.php";
$email = $_SESSION['user'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "delete from wishlist where product_id='$id' and email='$email'";
    if (mysqli_query($con, $q)) {
        setcookie('success', 'Product removed from wishlist', time() + 3);
?>
        <script>
            window.location.href = "user_wishlist.php";
            // exit();
        </script>
    <?php
    } else {
        setcookie('error', 'Error in removing product from wishlist.', time() + 3);
    ?>
        <script>
            window.location.href = "user_wishlist.php";
            // exit();
        </script>
<?php
    }
}
