<?php

require_once "include/common_staff.php";

$applicationRetrieveStatus = "";

$url = "http://LAPTOP-LYJK:8081/getalladoptionapplications";
$json = file_get_contents($url);
$data = json_decode($json);

if($data != false){
    $allApplications = $data->Application;
    $applicationCount = count($allApplications);
    $pendingApplicationArray = [];
    $approvedApplicationArray = [];
    $rejectedApplicationArray = [];
    $uniqueDogArray = [];

    for($i=0; $i<$applicationCount; $i++){
        $uniqueDogArray[] = $allApplications[$i]->dogID;
        if($allApplications[$i]->application_Status == "Pending"){
            $pendingApplicationArray[] = $allApplications[$i];
        }
        else if($allApplications[$i]->application_Status == "Approved"){
            $approvedApplicationArray[] = $allApplications[$i];
        }
        else if($allApplications[$i]->application_Status == "Rejected"){
            $rejectedApplicationArray[] = $allApplications[$i];
        }
    }

    $pendingApplicationCount = count($pendingApplicationArray);
    $approvedApplicationCount = count($approvedApplicationArray);
    $rejectedApplicationCount = count($rejectedApplicationArray);

    $uniqueDogCountArray = array_count_values($uniqueDogArray);
    $mostPopularDog = [];

    foreach($uniqueDogCountArray as $dogIDKey => $dogIDCount){
        if($dogIDCount == max($uniqueDogCountArray)){
            $mostPopularDog[$dogIDKey] = $dogIDCount;
        }
    }
    $applicationRetrieveStatus = "success";
}
else{
    echo "<h1>Unable to retrieve data, check if microservice is running in Tibco BW</h1>";
}


?>

<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>Adogtion</title>   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>  
<body>  

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="staffhome.php" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
            <!-- <a class="w3-bar-item">Welcome, <?php echo $_SESSION['firstName'].".";?></a> -->
                <div class="w3-right w3-hide-small">
                    <!-- <a href="staffhome.php" class="w3-bar-item w3-button">PENDING</a>
                    <a href="approvedApplications.php" class="w3-bar-item w3-button">APPROVED</a>
                    <a href="rejectedApplications.php" class="w3-bar-item w3-button">REJECTED</a> -->
                    <!--<a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>
                    <a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>-->
                    <div class="w3-dropdown-hover w3-hide-small">
                        <a class="w3-button w3-white" title="More">APPLICATIONS <i class="fa fa-caret-down"></i></a>     
                        <div class="w3-dropdown-content w3-bar-block w3-card-4">
                            <a href="staffhome.php" class="w3-bar-item w3-button">PENDING <?php echo "($pendingApplicationCount)"; ?></a>
                            <a href="approvedApplications.php" class="w3-bar-item w3-button">APPROVED <?php echo "($approvedApplicationCount)"; ?></a>
                            <a href="rejectedApplications.php" class="w3-bar-item w3-button">REJECTED <?php echo "($rejectedApplicationCount)"; ?></a>
                        </div>
                    </div>
                    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small">ABOUT</a> -->
                    <a href="staffhome.php" class="w3-bar-item w3-button w3-hide-small">LOGOUT</a>
                </div>
            <!--<a href="javascript:void(0)" class="w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>-->
        </div>
    </div>

    <div class="w3-content w3-padding" style="max-width:1564px">
        <div class="w3-container" style="margin-top: 30px;">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16"><b>Pending Adoption Applications</b> <span class="w3-tag w3-Light-Blue w3-round-medium"><?php echo $pendingApplicationCount?></span> </h3>

            <table id="myTable" class="table table-dark">  
                <thead class="thead-dark"> 
                    <tr>  
                        <th>Application ID</th>  
                        <th>Name</th> 
                        <th>Email</th> 
                        <th>Dog ID</th>
                        <th>Application Status</th> 
                        <th></th>   
                    </tr>  
                </thead>  
                <tbody id="populateTable">  
                    <?php

                        if($applicationRetrieveStatus == "success"){
                            if(!empty($pendingApplicationArray)){
                                foreach($pendingApplicationArray as $eachApplication){
                                    $applicationStatus = ucfirst($eachApplication->application_Status);
                                    echo "
                                    <tr class='w3-hover-opacity'>
                                        <td>$eachApplication->ApplicationID</td>
                                        <td>$eachApplication->firstName $eachApplication->lastName</td>
                                        <td>$eachApplication->email</td>
                                        <td>$eachApplication->dogID</td>
                                        <td>$applicationStatus</td>
                                        <td><a href='staff_view_application.php?appID=$eachApplication->ApplicationID&from=home'><b><u>View</u></b></a></td>
                                    </tr>
                                    ";
                                }
                            }
                        }

                    ?>
                </tbody>  
            </table>  

            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16"><b>Popular Dog(s)</b></h3>
            <?php 
                foreach($mostPopularDog as $eachPopularDogID => $eachPopularDogCount){
                    $url = "http://LAPTOP-LYJK:8080/dog/".$eachPopularDogID;
                    $json = file_get_contents($url);
                    $data = json_decode($json);

                    if($data != false){
                        echo "
                        <h4><b>A total of $eachPopularDogCount applications was submitted to adopt $data->name! (ID: $eachPopularDogID)</b></h4>
                        <img src='$data->pic1' height='300' width='300' style='border-radius: 15px;'>  
                        ";
                        
                    }
                    
                }
            ?>

        </div>
    </div>
</body>  
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</html>  