<?php
require 'config.php';
require_once 'auth.php';
check_login_and_role('HomeOwner');
    $db=$link;
        $sql= "SELECT * FROM Homeowner WHERE id ='".$_SESSION['user_id']."'";
        $result = mysqli_query($db, $sql);
        $homeowner = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
      <title>Home Owner HomePage</title>
      <meta charset="utf-8"> 
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css/HomeOwnerHomepage1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <script src="https://kit.fontawesome.com/b23f7a360e.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
     
      <script >
      function action1(type, id , ApplicID , statusid , seekerid) {
                    $.ajax({
                        type: "POST",
                        url: "PropertyOperations.php",
                        data: { Action:type,
                                PropertyID:id,
                                ApplicationID:ApplicID
                                },
                        success: function (response) {
                            if(response){
//                                alert(seekerid +" "+ id)
                                
                                $('#status-'+seekerid+'-'+id).text("accepted");
                                $('.statuss-'+id).not('#status-'+seekerid+'-'+id).text("declined");
                                                            

                            } else {
                                console.log("Status not updated in the DB");
                            } 
                        },
                        error: function() {
                             console.log("Status update request failed");
                        }
                    });
                }
                function action2(type, id , ApplicID , statusid , seekerid) {
                    $.ajax({
                        type: "POST",
                        url: "PropertyOperations.php",
                        data: { Action:type,
                                PropertyID:id,
                                StatusID:statusid
                                },
                        success: function (response) {
                            if(response){       
                                $('#status-'+seekerid+'-'+id).text("declined");

                            } else {
                                console.log("Status not updated in the data base");
                            } 
                        },
                        error: function() {
                             console.log("Status update request failed");
                        }
                    });
                }
            
      </script>
</head>
<body>
<header>
    <img src="img/RentZoneLogo.png" alt="logo" width="250" height="210">
    <h1 id="welcome">Welcome <em><?php echo $homeowner[1]; ?></em></h1>

    <div id="OwnerlInfoCon">
    <ul>
        <li><strong>Name:</strong> <em class="info"><?php echo $homeowner[1]; ?></em></li><br>
        <li><strong>Phone Number:</strong> <em class="info"><?php echo $homeowner[2]; ?> </em> </li><br>
        <li><strong>Email:</strong> <em class="info"><?php echo $homeowner[3]; ?></em> </li>
    </ul>
    </div>
</header>
<main>
    
   <a href="logout.php" id="sign-out">SignOut</a>
    
   <table id="t1">
        <caption>Rental Applications</caption>
        <tr Class = "table head">
            <th>Property Name</th>
            <th>Location</th>
            <th>Applicant</th>
            <th>Status</th>
        </tr>
         
 <?php  
    $sql2 = "SELECT * FROM Property WHERE homeowner_id = '".$homeowner[0]."' AND id IN (SELECT property_id FROM RentalApplication) ";
    $result2 = mysqli_query($db, $sql2);
    $prop = null;   
    
    if(mysqli_num_rows($result2) > 0){
        while($row2 = mysqli_fetch_assoc($result2)){   
                     
            if($row2['id'] == $prop ){
                continue;
            }else{
            
            $sql3 = "SELECT * FROM HomeSeeker WHERE id IN (SELECT home_seeker_id FROM RentalApplication WHERE property_id = ' " .$row2["id"].  " ' )";
            $result3 = mysqli_query($db, $sql3);
            
            
            if(mysqli_num_rows($result3) > 0){
                
                while($row3 = mysqli_fetch_assoc($result3)){  
                $sql4 = "SELECT * FROM ApplicationStatus WHERE id IN (SELECT application_status_id FROM RentalApplication  WHERE property_id = ' " .$row2["id"].  "' AND home_seeker_id= '" .$row3["id"].  "')";
                $result4 = mysqli_query($db, $sql4);    
                $row4 = mysqli_fetch_assoc($result4); 
                
                $sql5 = "SELECT id FROM RentalApplication WHERE property_id =' ".$row2["id"]."' AND home_seeker_id= ' " .$row3["id"].  " ' ";
                $result5 = mysqli_query($db, $sql5);    
                $row5 = mysqli_fetch_assoc($result5); 
                
                echo'<tr>';
                echo '<td><a href = "Property.php?PropertyID='.$row2["id"].'">' .$row2["name"]. "</a></td>";
                echo"<td>".$row2["location"]."</td>";
                echo '<td><a href = "ApplicantInformationPage.php?SeekerID='.$row3["id"].'  ">'  .$row3['first_name']." ". $row3['last_name'].  '</a></td>'; 
                
                 $s = $row3['id'] .'-'.$row2['id'] ;
                 $d = $row2["id"];
//                 echo $s;
                echo " <td  id='status-" .$s ."'   class='statuss-".$d. "' > " .$row4['status']. "</td>";  
//                echo 'status-' .$s;
                echo "<td><a href='#' onclick=\"action1('Accept',".$row2["id"].",".$row5["id"].",".$row4["id"]."," .$row3["id"] ." );\" >Accept</a> "
                        . "&#160;&#160;"
                        . "<a href='#' onclick=\"action2('Decline',".$row2["id"].",".$row5["id"].",".$row4["id"]."," .$row3["id"] .");\" >Decline</a></td>";
                echo'</tr>';   
                }          
            }  
          $prop = $row2["id"] ;  
        }
      }
      
    }else{
        echo "<tr> <td colspan='4' > You Have No Property Rental Application </td> </tr>";
    }
    ?>     
    </table>
    <br>
    <br>

    <?php echo "<a id='add-property' href='AddNewPropertyPage.php?HomeOwner=".$homeowner[0]."' > Add Property</a>"; ?>
    
    
    <table id="t2">    
        <caption>Listed Properties</caption>
        <tr Class = "table head">
            <th>Property Name</th>
            <th>Category</th>
            <th>Rent</th>
            <th>Room's</th>
            <th>Location</th>
        </tr>
        
         <?php
            $sql5 = "select * from Property where  homeowner_id = ' " . $homeowner[0] . " ' ";
            $result5 = mysqli_query($db, $sql5);

            if (mysqli_num_rows($result5) > 0) {
                while ($row5 = mysqli_fetch_assoc($result5)) {

                    $sql6 = "SELECT * FROM PropertyCategory WHERE id = ' " . $row5["property_category_id"] .  " ' ";
                    $result6 = mysqli_query($db, $sql6);
                    $row6 =  mysqli_fetch_assoc($result6);

                    echo "<tr id='del{$row5['id']}'>";
                    echo '<td><a href = "Property.php?PropertyID=' . $row5["id"] . '">' . $row5["name"] . '</a></td>';
                    echo "<td>" . $row6["PropertyCategory"] . "</td>";
                    echo '<td>' . $row5["rent_cost"] . '/month</td>';
                    echo '<td>' . $row5['rooms'] . '</td>';
                    echo '<td>' . $row5['location'] . '</td>';
                    echo "<td><a href='javascript:Delete({$row5['id']})'>Delete</a></td>";
                    echo '</tr>';
                }
            } else {
                echo "<tr> <td colspan='5' > You Have No Property </td> </tr>";
            }
            ?>
        </table>
    </main>
    <br>
    <br>
    <br>
    <br>
    <br>
</body>
<script>
    function Delete(property_id) {
        $.ajax({
            type: "POST",
            url: "deleteprop.php",
            dataType: "JSON",
            data: {
                Action: "Delete",
                id: property_id
            },
            success: res => {
                let row = document.getElementById('del'+property_id);
                 row.remove();
            },
            error : err => {
                console.log(err)
                alert("Failed to delete property " + property_id);
            }
        })
    }

</script>
</html>