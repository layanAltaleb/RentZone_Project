<?php

// this php code is the secirty layer added to each page after login

session_start();

function check_login_and_role($required_role)
{
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        // User is not logged in, redirect to the home page
        header("Location: index.php");
        exit;
    }
    
    if ($_SESSION['user_role'] !== $required_role) {
        // User role does not match the required role for the page, redirect to the home page
        header("Location: index.php");
        exit;
    }
}
?>