<?php
require 'config.php';
require_once 'auth.php';
check_login_and_role('HomeSeeker');

$conn = $link;

$id = $_SESSION["user_id"];
$sql = "SELECT * FROM `HomeSeeker` WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$homeseeker = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Seeker's HomePage</title>
    <meta charset="utf-8"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/HomeSeekerHomePage.css">
</head>
<body>
    <header>
        <img src="img/RentZoneLogo.png" alt="logo" width="200" height="200">
        <h1 id="welcome">Welcome <em><?php echo $homeseeker["first_name"] . " " . $homeseeker["last_name"]; ?></em></h1>
        <div id="seekerInfoCon">
            <ul>
                <li>First Name: <em class="info"><?php echo $homeseeker["first_name"]; ?></em></li><br>
                <li>Last Name: <em class="info"><?php echo $homeseeker["last_name"]; ?></em></li><br>
                <li>Number of Family Members: <em class="info"> <?php echo $homeseeker["family_members"]; ?> </em></li><br>
                <li>Phone Number: <em class="info"><?php echo $homeseeker["phone_number"]; ?></em></li><br>
                <li>Email: <em class="info"><?php echo $homeseeker["email_address"]; ?></em></li>
            </ul>
        </div>
    </header>
    <main>
       <a href="logout.php" id="sign-out">SignOut</a>

        <table id="t1">
            <caption>Requested Homes</caption>
            <tr>
                <th>Property Name</th>
                <th>Category</th>
                <th>Rent</th>
                <th>Status</th>
            </tr>
            <?php
            $query = "SELECT Property.name, PropertyCategory.PropertyCategory, Property.rent_cost, ApplicationStatus.status, Property.id
            FROM RentalApplication
            JOIN Property ON RentalApplication.property_id = Property.id
            JOIN PropertyCategory ON Property.property_category_id = PropertyCategory.id
            JOIN ApplicationStatus ON RentalApplication.application_status_id = ApplicationStatus.id
            WHERE RentalApplication.home_seeker_id = ' " . $homeseeker["id"]. "' ";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='Property.php?PropertyID=" . $row['id'] . "'>" . $row['name'] . "</a></td>";
                    echo "<td>" . $row['PropertyCategory'] . "</td>";
                    echo "<td>" . $row['rent_cost'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                echo "<td colspan='4'>No Requested Homes.</td>";
                echo "</tr>";
            }
            ?>
        </table>

        <table id="t2">
            <caption>Homes for Rent</caption>
            <div id="SearchByCategory"> 
                <label for="search">Search by Category:</label>
                
                <select id="search" placeholder="Category" name="category">
                    <option value="">All</option>
                    <?php
                    $query = "SELECT DISTINCT PropertyCategory FROM PropertyCategory";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['PropertyCategory'] . '">' . $row['PropertyCategory'] . '</option>';
                    }
                    ?>
                </select>
            </div>          
            <thead>
                <tr Class="table head">
                    <th>Property Name</th>
                    <th>Category</th>
                    <th>Rent</th>
                    <th>Room's</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody id="data2">
                <?php
                $query = "SELECT Property.*, PropertyCategory.PropertyCategory 
              FROM Property 
              LEFT JOIN RentalApplication ON Property.id = RentalApplication.property_id 
                AND RentalApplication.home_seeker_id = ' " .$homeseeker["id"]. "'
              INNER JOIN PropertyCategory ON Property.property_category_id = PropertyCategory.id";

                if (isset($_GET['category']) && !empty($_GET['category'])) {
                    $category = $_GET['category'];
                    $query .= " WHERE RentalApplication.id IS NULL AND PropertyCategory.PropertyCategory = '$category'";
                } else {
                    $query .= " WHERE RentalApplication.id IS NULL";
                }

                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='Property.php?PropertyID=" . $row['id'] . "'>" . $row['name'] . "</a></td>";
                        echo "<td>" . $row["PropertyCategory"] . "</td>";
                        echo "<td>" . $row["rent_cost"] . "</td>";
                        echo "<td>" . $row["rooms"] . "</td>";
                        echo "<td>" . $row["location"] . "</td>";
                        echo "<td><a href='HomeSeekerApply.php?id=" . $row["id"] . "'>Apply</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='6'> No Homes for Rent</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br><br>
        <br><br>
        <br><br>
    </main>
    <script>
        const srch = document.getElementById('search');
        
        srch.addEventListener('change', () => {
            $.ajax({
                type: "POST",
                url: "HomeSeekerFilter.php",
                dataType: "JSON",
                data: { 
                    category: srch.value
                },
                
                success: res => {
                    let data = ""
                    res.forEach( row => {
                        data = `${data} <tr>
                        <td><a href='Property.php?PropertyID=${row['id'] }'>${row['name']}</a></td>
                        <td>${row["PropertyCategory"]}</td>
                        <td>${row["rent_cost"]}</td>
                        <td>${row["rooms"]}</td>
                        <td>${row["location"]}</td>
                        <td><a href='HomeSeekerApply.php?id=${row["id"]}'>Apply</a></td>
                        </tr>`
                    });
                    if(res.length === 0) data = "<td colspan=6> No Homes for Rent </td>"
                    document.getElementById('data2').innerHTML = data;
                },
                error: err => {
                    console.log(err);
                    alert("ERROR FILTER CATEGORY!");
                } 
            })
        })
    </script>
</body>
</html>