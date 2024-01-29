<?php

require 'config.php'; 
require_once 'auth.php';
//check_login_and_role('HomeOwner'|| 'HomeSeeker');

$db = $link;

    $PropertyID = $_GET["PropertyID"];
    
    $sql = "SELECT * FROM  Property WHERE id = '$PropertyID '";
    $result = mysqli_query($db, $sql);    
    $row = mysqli_fetch_assoc($result); 

    $sql2 ="SELECT * FROM PropertyCategory where id='".$row["property_category_id"]."'"; 
    $result2 = mysqli_query($db, $sql2);    
    $row2 = mysqli_fetch_assoc($result2); 

    $query = mysqli_query($db, "SELECT * FROM propertyimage WHERE property_id = {$row['id']}");
    $photos = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
    if($_SESSION['user_role'] == 'HomeSeeker') {
      $sql = "SELECT * FROM  HomeSeeker  WHERE id = '".$_SESSION["user_id"]. "'";
      $result = mysqli_query($db, $sql);
      $homeseeker = mysqli_fetch_array($result);
      $name = $homeseeker[1];
      $href = "HomeSeekerHomepage.php";
                            
      } else{
      $sql = "SELECT * FROM  Homeowner  WHERE id = '".$_SESSION["user_id"]. "'";
       $result = mysqli_query($db, $sql);
       $Homeowner = mysqli_fetch_array($result);
       $name = $Homeowner[1];
       $href = "HomeOwnerHomePage.php";
                            
        } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/Property1.css">
    <title> <?php echo $row['name'] ?> </title>
</head>
<body>
    <header>
        <img src="img\logo.png" alt="logo" width="250" height="210">
        <h1 id ="welcome" >Welcome <em> <?php echo $name; ?> </em></h1>
    <ul>
        <li><a href="logout.php" id="sign-out" class = "nav">SignOut</a></li>
        <br>
        <br>
        
        <li><a href=<?php echo $href;?> id="back" class = "nav"> Back </a></li>
    </ul>
    </header>
    
    <div class="container">
        <div class="box">
            <div class="images">
                <div class="img-holder active" >
                    <img src="<?php echo $photos[0]['path'] ?>" width="260" height="310" id="img-holder">
                    <br>
                </div>
                <?php
                    foreach($photos as $img) {
                        echo " <div class='img-holder' >
                            <img src=\"{$img['path']}\" class='small' id='small' style='height:9rem; width=10rem;'>
                        </div>";
                    }
                ?>
            </div>
            <div class="basic-info">
                <br>
                <h1> <?php echo $row['name'] ?> </h1>
                
                <div class="options">
                    <?php 
                        if($_SESSION['user_role'] == 'HomeSeeker') 
                            echo "<a href='myapp.php?apply={$row['id']}'>Apply</a>" ;
                        else 
                            echo "<a href='EditPropertyPage.php?id={$row['id']}'>Edit</a>" ;
                    ?>
                </div>
                <br>
            </div>
            <div class="description">
                <p>              
                    the <?php echo $row2['PropertyCategory'] ?> consist of :<br>
                    <?php echo $row['description'] ?> 
                </p>
                <ul class="features">
                    <li><i class="fa-solid fa-circle-check"></i>category: <cite><?php echo $row2['PropertyCategory'] ?></cite> </li>
                    <li><i class="fa-light fa-bed-front"></i>number of rooms: <cite> <?php echo $row['rooms'] ?> </cite></li>
                    <li><i class="fa-solid fa-circle-check"></i>rent :<cite> <?php echo $row['rent_cost'] ?>/Month</cite></li>
                    <li><i class="fa-solid fa-circle-xmark"></i>location :<cite> <?php echo $row['location'] ?> </cite></li>
                    <li><i class="fa-solid fa-circle-xmark"></i>max number of tenant : <cite> <?php echo $row['max_tenants'] ?> </cite></li>
                    <br>
                </ul>                              
            </div>
        </div>
    </div>
    <script>
        var big_image=document.getElementById("img-holder");
        var smalling=document.getElementsByClassName("small");
        smalling[0].onclick=function(){
            big_image.src=smalling[0].src;
        }
        smalling[1].onclick=function(){
            big_image.src=smalling[1].src;
        }
        smalling[2].onclick=function(){
            big_image.src=smalling[2].src;
        }
        smalling[3].onclick=function(){
            big_image.src=smalling[3].src;
        }
        smalling[4].onclick=function(){
            big_image.src=smalling[4].src;
        }
    </script>
</body>
</html>