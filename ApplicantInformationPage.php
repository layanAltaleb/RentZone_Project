<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
require 'config.php'; 
require_once 'auth.php';
check_login_and_role('HomeOwner');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ApplicantInformationPage.css">
    <title>Applicant's Information</title>
</head>
<body>
    <header>
        <img src="img/RentZoneLogo.png" alt="logo" width="250" height="210">
        <h1 id="pageHeader">Applicant's Information</h1>
        <a href="HomeOwnerHomePage.php" id="back">Back</a>
        
    </header>
    <main>
        <div id="frame">
            <ul>
                <?php
                $seekerID = $_GET["SeekerID"];
                $sql = "SELECT * FROM HomeSeeker WHERE id = $seekerID ";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_assoc($result); 
                ?>
                <li><strong> Name: </strong><em> <?php echo $row["first_name"]?> </em><hr></li>
                <li><strong>Last Name: </strong><em>  <?php echo $row["last_name"]?> </em><hr></li>
                <li><strong>Age: </strong><em>   <?php echo $row["age"]?> </em><hr></li>
                <li><strong>Number of family members: </strong><em>  <?php echo $row["family_members"]?> </em><hr></li>
                <li><strong>Email: </strong><em>  <?php echo $row["email_address"]?> </em><hr></li>
                <li><strong>Phone number:  <em><?php echo $row["phone_number"]?></em></strong></li>

            </ul>
       
                
        </div>

    </main>
    
</body>
</html>
