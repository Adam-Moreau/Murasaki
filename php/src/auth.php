<?php 

session_start(); // Start a PHP session

// Check if the user is logged in and is an admin
if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['is_admin']) ||
    !$_SESSION['is_admin']
) {
    // User is not logged in or is not an admin, redirect to the login page
    header('Location: mithrandir-portal.php');
    exit();
}