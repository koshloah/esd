<?php

require_once "include/common.php";
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

if(isset($_SESSION["dogList"])){
    $allDogs = $_SESSION["dogList"];
    foreach($allDogs as $eachDog){
        $uniqueDogBreeds[]=$eachDog->breed;
    }
    $dogBreeds = array_unique($uniqueDogBreeds);
    $dogBreedStatus = "success";
    if(isset($_SESSION["breed"])){
        $selectedDogBreed = $_SESSION["breed"];

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
// retrieve from dog service if session is empty
else{
    $url = "http://LAPTOP-LYJK:8080/dogs";
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
    }
    else{
        header("Location: home.php");
    }
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
<div class="w3-content w3-padding" style="max-width:1564px">
    <div class="w3-container" style="margin-top:40px;">
        <h1><b>Adopt, Don't Shop!</b></h1>
        <form action="adopt.php" method="post">
            <table>
                <tr>
                    <td><b>Breed:</b></td>
                    <td>
                        <input list="breeds" name="breed" class="w3-select" style="padding-left:10px; width: 300px;" placeholder="All" value="<?php if($selectedDogBreed != '' && $selectedDogBreed != 'All'){ echo $selectedDogBreed;}?>">
                        <datalist id="breeds">
                            <option value="All">
                            <option value="Tibco">
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
                        <h4><b>We currently do not have any <u>$selectedDogBreed</u> dogs.</b></h4>
                        <h5>Would you like to subscribe to our notification service? You will receive a notification when a $selectedDogBreed is available.</h5>
                        <form action='http://www.google.com'>
                            <b>Email:</b><input class='w3-input w3-border' type='text' name='email' placeholder='abc@mail.com' required>
                            <td><button class='w3-button w3-black w3-section' type='submit' name='subscriptionButton'>Subscribe <i class='fa fa-paw'></i></button></td>
                        </form>
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
                                <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' class='w3-hover-sepia' style='width:280px; height:280px; border-radius: 4%;' id='img$counter'> </a>
                            </div>
                        </div>";
                    }
                    // else{
                    //     $availableStatus = "Adopted";
                    //     echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                    //         <div class='w3-display-container'>
                    //             <div class='w3-display-topleft w3-red w3-padding'>$eachDog->name, $availableStatus</div>
                    //             <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' style='width:280px; height:280px; id='img$counter'> </a>
                    //         </div>
                    //     </div>";
                    // }
                    
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