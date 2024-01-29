<?php
session_start();
require_once 'config.php';

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role === 'HomeSeeker') {
$check_user_query = "SELECT id, password FROM HomeSeeker WHERE email_address = ?";
} else {
$check_user_query = "SELECT id, password FROM Homeowner WHERE email_address = ?";
}

$stmt = $link->prepare($check_user_query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
$row = $result->fetch_assoc();
$hashed_password = $row['password'];

if (password_verify($password, $hashed_password)) {
// Password is correct, create session variables and redirect to the appropriate homepage
$_SESSION['user_id'] = $row['id'];
$_SESSION['user_role'] = $role;

    if ($role === 'HomeSeeker') {
        header("Location: HomeSeekerHomepage.php");
    } else {
        header("Location: HomeOwnerHomepage.php");
    }
    
} else {
    // Password is incorrect, set error message and redirect to the login page
    $_SESSION['error_message'] = 'The provided password is incorrect. Please try again.';
    $error =  $_SESSION['error_message'];
    header("Location: login.php?ERROR=$error");
}
} else {
    // Password is incorrect, set error message and redirect to the login page
    $_SESSION['error_message'] = 'The provided Email is unavailable. Please try again.';
    $error =  $_SESSION['error_message'];
header("Location: login.php?ERROR=$error");}

$stmt->close();
$link->close();

?>