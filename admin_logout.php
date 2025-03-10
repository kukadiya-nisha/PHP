<?php
session_start();

unset($_SESSION['admin']);
?>
<script>
    window.location.href = "login.php";
</script>