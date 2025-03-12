<?php
try {
    $con = mysqli_connect("localhost", "root", "", "php");
    // try {
    //     $q = "CREATE DATABASE IF NOT EXISTS `2024_25_4DCE_A_B_Sample`";

    //     if ($con->query($q)) {
    //         echo "Database Created Successfully";
    //     }
    // } catch (Exception $e) {
    //     echo "Error in Creating Database" . $e->getMessage();
    // }

    //create Registration table

    //     try {
    //         $registration = "CREATE TABLE `registration` (
    //   `id` int primary key AUTO_INCREMENT,
    //   `firstname` char(20) NOT NULL,
    //   `lastname` char(20) NOT NULL,
    //   `email` varchar(50) NOT NULL unique,
    //   `mobile` bigint NOT NULL,
    //   `password` varchar(30) NOT NULL,
    //   `profile_picture` varchar(100) NOT NULL DEFAULT 'default.jpg',
    //   `role` char(10)  NOT NULL DEFAULT 'User',
    //   `status` char(10) NOT NULL DEFAULT 'Inactive'
    // )";

    // $q = "CREATE TABLE password_token (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL, otp INT NOT NULL,created_at DATETIME NOT NULL,expires_at DATETIME NOT NULL)";
    // try {
    //     if ($con->query($q)) {
    //         echo "Table Created Successfully";
    //     }
    // } catch (Exception $e) {
    //     echo "Error in Creating Table" . $e->getMessage();
    // }
} catch (Exception $e) {
    echo "Error in Connecting with Database Server" . $e->getMessage();;
}
