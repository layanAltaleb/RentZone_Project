<!DOCTYPE html>
<html>

<head>
    <title>Edit Proretry Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/AddNewPropertyPage1.css">
    <link rel="stylesheet" href="css/EditProretryPage.css">
    <script src="https://kit.fontawesome.com/b23f7a360e.js" crossorigin="anonymous"></script>

</head>

<?php
    include('config.php');
    require_once 'auth.php';
    
    $db = $link;
   $property_id = $_GET['id'];
   
    $query = mysqli_query($db, "SELECT property.* , propertycategory.propertycategory FROM property
        JOIN propertycategory on propertycategory.id = property.property_category_id
        WHERE property.id = {$_GET['id']}");

    $pro = mysqli_fetch_assoc($query);


    $query = mysqli_query($db, "SELECT * FROM propertyimage WHERE property_id = {$pro['id']}");
    $photos = mysqli_fetch_all($query, MYSQLI_ASSOC);

    $sql= "SELECT * FROM Homeowner WHERE id ='".$_SESSION['user_id']."'";
    $result = mysqli_query($db, $sql);
    $homeowner = mysqli_fetch_array($result);
    
    $query = mysqli_query($db, "SELECT * FROM propertycategory");
    $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<body>
    <header>
        <img src="img/RentZoneLogo.png" alt="logo" width="250" height="210">
        <h1 id="welcome">Welcome <em><?php echo $homeowner[1]; ?></em>  <em></em></h1>

    </header>
    <ul>
        <li><a href="HomePage.php" id="sign-out" class="nav">SignOut</a></li>
        <br>
        <br>
        <li><a href="Property.php?PropertyID=<?php echo $property_id ?>" id="back" class="nav"> Back </a></li>
    </ul>
    <div class="container">
        <form action="myapp.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-25"><label>Property Name</label></div>
                <div class="col-75"><input required type="text" id="propertyName" name="propertyName" required value="<?php echo $pro['name'] ?>"></div>
            </div>


            <div class="row">
                <div class="col-25"><label>Number of Room's</label></div>
                <div class="col-75"><input required type="text" id="numberOfRooms" name="numberOfRooms" required value=<?php echo $pro['rooms'] ?>></div>
            </div>


            <div class="row">
                <div class="col-25"><label>Rent</label></div>
                <div class="col-75"><input required type="text" id="Rent" name="Rent" required value=<?php echo $pro['rent_cost'] ?>></div>
            </div>


            <div class="row">
                <div class="col-25"><label> Max Number of Tenant's</label></div>
                <div class="col-75"><input required type="text" id="numTenants" name="numTenants" required value=<?php echo $pro['max_tenants'] ?>></div>
            </div>


            <div class="row">
                <div class="col-25"><label>Location</label></div>
                <div class="col-75"><input required type="text" id="Location" name="Location" required value="<?php echo $pro['location'] ?>"></div>
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
                <div class="col-25"><label>Description</label></div>
                <div class="col-75"><textarea id="description" name="description" style="height:200px">
                <?php echo $pro['description'] ?>
                </textarea></div>
            </div>

            <br>
            <div class="row">
                <div class="col-25"><label>Pictures of The Property</label></div>

                <div class="col-75" id="flexxx">

                    <label style="font-size:1.4rem;">Upload Images</label>
                    <input type="file" name="images[]" accept="image/*" multiple>
                    
                    <?php 
                        foreach($photos as $img){
                            echo "<div class='col-75' id='flexx'>
                            <div><img src=\"{$img['path']}\" width='65' height='65'>
                            <br><a href='myapp.php?delete={$img['id']}&prop={$pro['id']}'>Delete</a></div>
                            </div>";
                        }
                    ?>

                </div>
            </div>

            <br>
            <input hidden name="proid" value=<?php echo $pro['id'] ?> >
            <div class="row">
                <input type="submit" value="Save" name="update">
            </div>

        </form>
    </div>
</body>

</html>