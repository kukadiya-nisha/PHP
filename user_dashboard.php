<?php
include_once("header.php");
include_once("user_check_authentication.php");
?>

<h1>
    <?php echo $_SESSION['user']; ?>
</h1>