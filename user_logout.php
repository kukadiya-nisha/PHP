<?php
session_start();

unset($_SESSION['user']);
?>
<script>
    window.location.href = "login.php";
</script>