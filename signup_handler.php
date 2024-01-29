<?php
session_start();
require_once 'config.php';

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$age = $_POST['age'];
$familyMembers = $_POST['familyMembers'];
$income = $_POST['income'];
$job = $_POST['job'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role === 'HomeSeeker') {
    $check_email_query = "SELECT id FROM HomeSeeker WHERE email_address = ?";
} else {
    $check_email_query = "SELECT id FROM Homeowner WHERE email_address = ?";
}

$stmt = $link->prepare($check_email_query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error_message'] = "The provided email address is already in use. Please use a different email.";
    $error =  $_SESSION['error_message'];
    header("Location: signup.php?ERROR=$error");
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'HomeSeeker') {
        $insert_query = "INSERT INTO HomeSeeker (first_name, last_name, age, family_members, income, job, phone_number, email_address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    } else {
        $insert_query = "INSERT INTO Homeowner (name, phone_number, email_address, password) VALUES (?, ?, ?, ?)";
    }

    $stmt = $link->prepare($insert_query);

    if ($role === 'HomeSeeker') {
        $stmt->bind_param('ssiiissss', $firstName, $lastName, $age, $familyMembers, $income, $job, $phone, $email, $hashed_password);
    } else {
        $name = $firstName . ' ' . $lastName;
        $stmt->bind_param('siss', $name, $phone, $email, $hashed_password);
    }

    $stmt->execute();

    if ($role === 'HomeSeeker') {
        header("Location: HomeSeekerHomepage.php");
    } else {
        header("Location: HomeOwnerHomepage.php");
    }
}

$stmt->close();
$link->close();
?>