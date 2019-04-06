<?php

require_once "include/common_staff.php";
require_once "include/servicesURL.php";
//require_once "include/DogDAO.php";

/*$dogdb = new DogDAO();
$dogBreeds = $dogdb->getBreeds();
//var_dump($dogBreeds);
if($dogBreeds != false){
    $dogBreedStatus = "success";
}
else{
    $errors[] = "Unable to get list of breeds";
    $_SESSION["errormsg"] = $errors;
    header("Location: adopt-view.php");
}*/

$dogBreedStatus = "";
$selectedDogBreed = ""; 
$uniqueDogBreeds = [];
$subscriptionMessage = "";

$url = $dogManagementServiceURL;
$json = file_get_contents($url);
$data = json_decode($json);

if($data != false){
    $allDogs = $data->Dog;
    foreach($allDogs as $eachDog){
        $uniqueDogBreeds[]=$eachDog->breed;
    }
    $dogBreeds = array_unique($uniqueDogBreeds);
    $dogBreedStatus = "success";
    $_SESSION["dogList"] = $allDogs;

    $dogBreedStatus = "success";
    if(isset($_SESSION["staff_breed"])){
        $selectedDogBreed = $_SESSION["staff_breed"];

        if(isset($_REQUEST["subscriptionButton"])){
            if(isset($_REQUEST["email"])){
                $enteredEmail = $_REQUEST["email"];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $newSubscriptionServiceURL);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"email\": \"$enteredEmail\"  \n }");
                curl_setopt($ch, CURLOPT_POST, 1);

                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Accept: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close ($ch);

                if( strpos( $result, "Duplicate entry" ) !== false) {
                    // email already exists
                    $subscriptionMessage = "<h4><b><span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span> You have already subscribed to Adogtion Newsletter Email Service.</b></h4>";
                }
                else{
                    $subscriptionMessage = "<h4><b><span style='font-size: 1em; color: green;'><i class='fas fa-check-circle'></i></span> You have subscribed to Adogtion Newsletter Email Service.</b></h4>";
                }
            }
        
        }
        else{
            $subscriptionMessage = "";
        }

        if($selectedDogBreed == "All" || $selectedDogBreed == ""){
            
        }
        else{
            $filteredDogList = [];
            foreach($allDogs as $eachDog){
                if($eachDog->breed==$selectedDogBreed){
                    $filteredDogList[]=$eachDog;
                }
            }
            $allDogs = $filteredDogList;
        }
        
    }
}
else{
    header("Location: staffhome.php");
}



//var_dump($_REQUEST);


/*if(isset($_SESSION["dogList"])){
    $allDogStatus = "success";
    $allDogs = $_SESSION["dogList"];
    if(isset($_SESSION["selectedDogBreed"])){
        $selectedDogBreed = $_SESSION["selectedDogBreed"];
        var_dump($selectedDogBreed);
    }
    
}
else{
    $allDogs = $dogdb->retrieve("All");
    //var_dump($allDogs);
    if($allDogs != false){
        $allDogStatus = "success";
    }
    else{
        $errors[] = "Unable to get all dogs";
        $_SESSION["errormsg"] = $errors;
        header("Location: adopt-view.php");
    }
}*/

?>
<!DOCTYPE html>
<html>
<body>
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="staffhome.php" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
            <!-- <a class="w3-bar-item">Welcome, <?php echo $_SESSION['firstName'].".";?></a> -->
                <div class="w3-right w3-hide-small">
                    <a href="updateDogs.php" class="w3-bar-item w3-button">UPDATE DOGS</a>
                    <!-- <a href="staffhome.php" class="w3-bar-item w3-button">PENDING</a>
                    <a href="approvedApplications.php" class="w3-bar-item w3-button">APPROVED</a>
                    <a href="rejectedApplications.php" class="w3-bar-item w3-button">REJECTED</a> -->
                    <!--<a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>
                    <a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>-->
                    <div class="w3-dropdown-hover w3-hide-small">
                        <a class="w3-button w3-white" title="More">APPLICATIONS <i class="fa fa-caret-down"></i></a>     
                        <div class="w3-dropdown-content w3-bar-block w3-card-4">
                            <a href="staffhome.php" class="w3-bar-item w3-button">PENDING</a>
                            <a href="approvedApplications.php" class="w3-bar-item w3-button">APPROVED</a>
                            <a href="rejectedApplications.php" class="w3-bar-item w3-button">REJECTED</a>
                        </div>
                    </div>
                    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small">ABOUT</a> -->
                    <a href="staffhome.php" class="w3-bar-item w3-button w3-hide-small">LOGOUT</a>
                </div>
            <!--<a href="javascript:void(0)" class="w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>-->
        </div>
    </div>



<div class="w3-content w3-padding" style="max-width:1564px">
    <div class="w3-container" style="margin-top:40px;">
        <h1><b>Dogs Management</b></h1>
        <form action="staffadopt.php" method="post">
            <table>
                <tr>
                    <td><b>Breed:</b></td>
                    <td>
                        <input list="breeds" name="breed" class="w3-select" style="padding-left:10px; width: 300px;" placeholder="All" value="<?php if($selectedDogBreed != '' && $selectedDogBreed != 'All'){ echo $selectedDogBreed;}?>">
                        <datalist id="breeds">
                            <option value="All">
                            <!-- <option value="Husky"> -->
                            <?php
                                if($dogBreedStatus == "success"){
                                    foreach($dogBreeds as $eachbreed){
                                        echo "<option value='$eachbreed'>";
                                    }
                                }
                            ?>
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'><button class="w3-button w3-black w3-section" type="submit" name="submitBtn">Search <i class="fa fa-search"></i></button></td>
                </tr>

            </table>
        </form>
        <!-- <h3 class="w3-border-bottom w3-border-light-grey" style="margin-top:-15px">Our Dogs:</h3> -->
    </div>

    <hr  style="margin-top:-15px">

    <div class="w3-container">
        <?php
            if(empty($allDogs)){
                echo "
                    <div class='w3-display-container' style='margin-top:-10px;'>
                        <h4><b>We currently do not have any $selectedDogBreed.</b></h4>
                        <h5>Subscribe to our Adogtion Newsletter Email Service to receive the list of latest available dogs.</h5>
                        <form action='adopt-view.php' method='POST'>
                            <b>Email:</b><input class='w3-input w3-border' type='email' name='email' placeholder='abc@mail.com' required>
                            <td><button class='w3-button w3-black w3-section' type='submit' name='subscriptionButton'>Subscribe <i class='fa fa-paw'></i></button></td>
                        </form>
                        $subscriptionMessage
                    </div>";
                    
            }
            else{
                $counter = 1;
                $availableStatus = "";
                foreach ($allDogs as $eachDog){
                    if($eachDog->status == "A"){
                        $availableStatus = "Available";
                        echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                            <div class='w3-display-container'>
                                <div class='w3-display-bottomleft w3-green w3-padding'>$eachDog->name, $availableStatus</div>
                                <a href='staffviewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' class='w3-hover-sepia' style='width:280px; height:280px; border-radius: 4%; object-fit: cover;' id='img$counter'> </a>
                            </div>
                        </div>";
                    }
                    else{
                        $availableStatus = "Adopted";
                        echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                            <div class='w3-display-container'>
                                <div class='w3-display-bottomleft w3-red w3-padding'>$eachDog->name, Not Available</div>
                                <a href='staffviewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' class='w3-hover-sepia' style='width:280px; height:280px; border-radius: 4%; object-fit: cover;' id='img$counter'> </a>
                            </div>
                        </div>";
                    }
                    
                    $counter += 1;
                }
            }       
        ?>
    </div>

    
    
<?php
printErrors();
?>

</div>

</body>
</html>