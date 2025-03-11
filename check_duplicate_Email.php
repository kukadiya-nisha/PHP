<?php
include_once 'db_connect.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $q = "SELECT * FROM `registration` WHERE `email`='$email'";
    $result = $con->query($q);
    if ($result->num_rows > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
}
