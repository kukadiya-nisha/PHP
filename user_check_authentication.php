<?php
session_start();
if (!isset($_SESSION['user'])) {
?>
    <script>
        window.location.href = "login.php";
    </script>
<?php
}
