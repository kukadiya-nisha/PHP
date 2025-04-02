<?php
include_once 'db_connect.php';
session_start();
ob_start();
$email=$_SESSION['admin'];

if (isset($_GET['cpassword'])) {
   $cpwd = $_GET['cpassword'];
    $q = "SELECT * FROM `registration` WHERE `email`='$email'";
    $result = $con->query($q);
    $row = mysqli_fetch_assoc($result);
    if ($cpwd == $row['password']) {
        echo 'true';
    } else {
        echo 'false';
    }
}
