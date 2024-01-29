<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


session_start();

// Unset session variables and destroy the session
session_unset();
session_destroy();

// Redirect the user to the home page
header("Location: index.php");
exit;
?>