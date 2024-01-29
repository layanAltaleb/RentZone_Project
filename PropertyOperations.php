<?php
require 'HomeOwnerHomePage.php';


if($_POST["Action"] == "Accept"){
    
   $property_id = $_POST["PropertyID"];
   $ApplicationID = $_POST["ApplicationID"];
  
   $sql = "SELECT * FROM RentalApplication Where property_id = ' $property_id '";
   $result = mysqli_query($db, $sql);
   
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){  

            if($row["id"] == $ApplicationID){
                $sql = "UPDATE ApplicationStatus SET status = 'accepted'  WHERE id = ' " .$row["application_status_id"]. " ' ";
                $res =  mysqli_query($db, $sql);  

            }else{
                $sql = "UPDATE ApplicationStatus SET status = 'declined'  WHERE id = ' " .$row["application_status_id"]. " ' ";
                mysqli_query($db, $sql);
           }
        }  
         echo $res;
        
    }
}



if($_POST["Action"] == "Decline"){
    $StatusID = $_POST["StatusID"];
    
     $sql = "UPDATE ApplicationStatus SET status = 'declined'  WHERE id = '$StatusID ' ";
     $res = mysqli_query($db, $sql);
     
       echo $res;
}

?>