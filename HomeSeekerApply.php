<?php
require 'config.php';
require_once 'auth.php';
check_login_and_role('HomeSeeker');
$conn = $link;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $property_id = $_GET["id"];
    $homeseeker_id = $_SESSION["user_id"];


    $property_id = $conn->real_escape_string($property_id);
    $homeseeker_id = $conn->real_escape_string($homeseeker_id);

    $fetc = $conn->query("SELECT * FROM RentalApplication WHERE property_id = '$property_id' AND home_seeker_id = '$homeseeker_id'");

    if ($fetc->num_rows > 0) {
        header("Location: HomeSeekerHomepage.php");
    } else {
        $query = $conn->query("INSERT INTO ApplicationStatus (status) VALUES (DEFAULT)");

        if ($query) {
            $lastInsertId = $conn->insert_id;

            $fetc = $conn->query("INSERT INTO RentalApplication (property_id, home_seeker_id, application_status_id) VALUES ('$property_id', '$homeseeker_id', '$lastInsertId')");

            if ($fetc) {
               header("Location: HomeSeekerHomepage.php");
            } else {
                echo "Error submitting application.";
            }
        } else {
            echo "Error creating application status.";
        }
    }

    $conn->close();
} else {
    echo "Invalid id.";
}
?>