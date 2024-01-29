<?php
require_once 'auth.php';
require 'config.php';
check_login_and_role('HomeSeeker');
$conn = $link;

if(!isset($_SESSION)) session_start();

$sql = "SELECT Property.*, PropertyCategory.PropertyCategory FROM Property 
LEFT JOIN RentalApplication ON Property.id = RentalApplication.property_id 
AND RentalApplication.home_seeker_id = {$_SESSION['user_id']}
INNER JOIN PropertyCategory ON Property.property_category_id = PropertyCategory.id
WHERE RentalApplication.id IS NULL ";

if($_POST['category'] != "") 
    $sql .= " AND PropertyCategory.PropertyCategory LIKE \"{$_POST['category']}\"";

// echo $sql.`<br>`;
$query = mysqli_query($conn, $sql);
echo json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));

