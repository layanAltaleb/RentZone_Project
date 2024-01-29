<?php 
require 'config.php';
require_once 'auth.php';
check_login_and_role('HomeOwner');
$db=$link;

    $sql= "SELECT * FROM Homeowner WHERE id ='".$_SESSION['user_id']."'";
    $result = mysqli_query($db, $sql);    
    $row = mysqli_fetch_assoc($result);

    $query = mysqli_query($db, "SELECT * FROM propertycategory");
    $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);
 
?>
<!DOCTYPE html>
<html> 
<head>
      <title>Add New Proretry Page</title>
      <meta charset="utf-8"> 
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css/AddNewPropertyPage1.css">
</head>

<body>
<header>
    <img src="img/RentZoneLogo.png" alt="logo" width="250" height="210">
    <h1 id="welcome">Welcome <em> <?php echo $row["name"]?></em></h1>
</header>
    <ul >
        <li><a href="logout.php" id="sign-out" class = "nav">SignOut</a></li>
        <br>
        <br>
        <li><a href="HomeOwnerHomePage.php" id="back" class = "nav"> Back </a></li>
    </ul>

    <div class="container">
        <form action="myapp.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-25"><label >Property Name</label></div>
                <div class="col-75"><input required type="text" id="propertyName" name="propertyName" placeholder="Enter propertyName.." required></div>
            </div>


            <div class="row">
                <div class="col-25"><label >Number of Room's</label></div>
                <div class="col-75"><input required type="number" id="numberOfRooms" name="numberOfRooms" placeholder="Enter Number of Room's" required></div>
            </div>


            <div class="row">
                <div class="col-25"><label >Rent</label></div>
                <div class="col-75"><input required type="number" id="Rent" name="Rent" placeholder="Enter Rent" required></div>
            </div>


            <div class="row">
                <div class="col-25"><label > Max Number of Tenant's</label></div>
                <div class="col-75"><input required type="number" id="numTenants" name="numTenants" placeholder="Enter Max Number of Tenant's" required></div>
            </div>


            <div class="row">
                    <div class="col-25"><label >Location</label></div>
                    <div class="col-75"><input required type="text" id="Location" name="Location" placeholder="Enter Location.." required></div>
            </div>


            <div class="row">
                <div class="col-25"><label for="Category">Category</label></div>
                <div class="col-75">
                    <select id="search" placeholder=" Enter Category" name="category" required>   
                        <option value="" disabled selected>Select your category</option>
                    <?php 
                        foreach($categories as $cat){
                            echo "<option value={$cat['id']}>{$cat['PropertyCategory']}</option>";
                        }
                    ?>
                    </select>
                </div>
            </div>
            

            <div class="row">
                <div class="col-25"><label >Description</label></div>
                <div class="col-75"><textarea id="description" name="description" placeholder="Enter Description.." style="height:200px"></textarea></div>
            </div>

            <br>
            <div class="row"> 
                <div class="col-25"><label >Pictures of The Property</label></div>
                <div class="col-75">
                    <input required type="file" name="proPictures[]" accept="image/*" multiple>
                </div>
            </div>

            <br>
            
            <div class="row">
                 <input type="submit" name="addproperty" value="Submit">
            </div>

        </form>
    </div>
</body>

</html>