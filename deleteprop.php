<?php 

require_once 'auth.php';
require 'config.php';
check_login_and_role('HomeOwner');
$conn = $link;


if ($_POST["Action"] == "Delete") {
    $id = $_POST["id"];
    $sql = "DELETE FROM propertyimage where property_id = $id";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM rentalapplication where property_id = $id";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM Property WHERE id='" . $id . "'";
    mysqli_query($conn, $sql);
    
    echo json_encode("success");
}
