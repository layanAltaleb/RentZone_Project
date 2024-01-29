<?php
require 'config.php';
require_once 'auth.php';
$db = $link;



if(isset($_POST['addproperty'])){
    check_login_and_role('HomeOwner');
    $sql = "INSERT INTO property(homeowner_id, property_category_id, name,
    rooms, rent_cost, location, max_tenants, description) VALUES (
        {$_SESSION['user_id']},
        {$_POST['category']},
        \"{$_POST['propertyName']}\",
        {$_POST['numberOfRooms']},
        {$_POST['Rent']},
        \"{$_POST['Location']}\",
        {$_POST['numTenants']},
        \"{$_POST['description']}\"
    )";

    echo $sql;
    mysqli_query($db, $sql);

    $query = mysqli_query($db, "SELECT id FROM property ORDER BY id DESC LIMIT 1");
    $id = mysqli_fetch_array($query)[0];
    
    if(isset($_FILES['proPictures'])){

        $images = $_FILES['proPictures'];
        foreach(array_keys($images['name']) as $i){
            
            $name = rand().'_'.time().'_'.$images['name'][$i];
            $path = "img/".$name;
            move_uploaded_file($images['tmp_name'][$i], $path);
            
            $sql = "INSERT INTO propertyimage (property_id, path) VALUES ($id, \"$path\")";
            mysqli_query($db, $sql);
        }
    }

    header("location:Property.php?PropertyID=$id");
}  


if(isset($_GET['apply'])) {
    check_login_and_role('HomeSeeker');
    $prop_id = $_GET['apply'];
    $seeker_id = $_SESSION['user_id'];
    
     $fetc = $db->query("SELECT * FROM RentalApplication WHERE property_id = '$prop_id' AND home_seeker_id = '$seeker_id'");
    if ($fetc->num_rows > 0) {
         header("Location: HomeSeekerHomepage.php");

    }else{
        
        $fetc = $db->query("SELECT * FROM RentalApplication WHERE property_id = '$property_id' AND home_seeker_id = '$homeseeker_id'");

        if ($fetc->num_rows > 0) {
             header("Location: HomeSeekerHomepage.php");
        } else {
        $query = $db->query("INSERT INTO ApplicationStatus (status) VALUES (DEFAULT)");

        if ($query) {
            $lastInsertId = $db->insert_id;

            $fetc = $db->query("INSERT INTO RentalApplication (property_id, home_seeker_id, application_status_id) VALUES ('$prop_id', '$seeker_id', '$lastInsertId')");
               
            if ($fetc) {
               header("Location: HomeSeekerHomepage.php");
            } else {
                echo "Error submitting application.";
            }
}}}}
        
        
        
        

if(isset($_POST['update'])) {
    check_login_and_role('HomeOwner');
//    $cat = $_POST['category'];
    $property_id = $_POST['proid'];
    
//    $sql = "UPDATE PropertyCategory SET PropertyCategory = '$cat' 
//    WHERE id IN (SELECT property_category_id FROM property WHERE id = '$property_id' )";
//    mysqli_query($db, $sql);
    

    $sql2 = "UPDATE Property  SET 
        location = \"{$_POST['Location']}\",
        rooms = {$_POST['numberOfRooms']},
        name = \"{$_POST['propertyName']}\", 
        max_tenants = {$_POST['numTenants']},
        property_category_id =  {$_POST['category']},   
        description = \"{$_POST['description']}\",
        rent_cost = {$_POST['Rent']}
        WHERE id = $property_id
    ";
           
    mysqli_query($db, $sql2);
    
    if(isset($_FILES['images'])) {
       
        $images = $_FILES['images'];
        foreach(array_keys($images['name']) as $i){
            
            $name = rand().'__'.$images['name'][$i];
            if($images['name'][$i] == '') continue;
            $path = "img/".$name;
            move_uploaded_file($images['tmp_name'][$i], $path);
            
            $sql = "INSERT INTO propertyimage (property_id, path) VALUES ($property_id, \"$path\")";
            mysqli_query($db, $sql);
            
        }
    }
    
    header("location:Property.php?PropertyID={$property_id}");
}

if(isset($_GET['delete'])) {
    check_login_and_role('HomeOwner');
    $image = $_GET['delete'];
    
    $query = mysqli_query($db, "SELECT * FROM propertyimage WHERE id = $image ");
    $file = "./".mysqli_fetch_assoc($query)['path'];
    if(file_exists($file)) unlink($file);

    $sql = "DELETE FROM propertyimage WHERE id = $image ";
    mysqli_query($db, $sql);
    
    header("location:editpropertypage.php?id={$_GET['prop']}");
   
}


?>