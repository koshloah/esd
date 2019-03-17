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
$selectedDogBreed =""; 
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


var_dump($_REQUEST);


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


    <div class="w3-container" id="appplication_status" style="margin-top:20px;">
        <h1>Adopt, Don't Shop!</h1>
        <form action="adopt.php" method="post">
        <table>
            <tr>
                <td><b>Breed:</b></td>
                <td>
                    <input list="breeds" name="breed" class="w3-select" style="padding-left:10px; width: 300px;" placeholder="All" value="<?php if($selectedDogBreed != '' && $selectedDogBreed != 'All'){ echo $selectedDogBreed;}?>">
                    <datalist id="breeds">
                        <option value="All">
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
                <td><button class="w3-button w3-black w3-section" type="submit" name="submitBtn">Search</button></td>
            </tr>

        </table>
        </form>
        
        <!-- Newly Listed Section -->
        <div class="w3-container" id="newly_listed">
            <h3 class="w3-border-bottom w3-border-light-grey">Look at all the good dogs:</h3>
        </div>

        <div class="w3-row-padding">
            <?php
                $counter = 1;
                $availableStatus = "";
                foreach ($allDogs as $eachDog){
                    if($eachDog->status == "A"){
                        $availableStatus = "Available";
                        echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                            <div class='w3-display-container'>
                                <div class='w3-display-topleft w3-green w3-padding'>$eachDog->name, $availableStatus</div>
                                <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' style='width:280px; height:280px; id='img$counter'> </a>
                            </div>
                        </div>";
                    }
                    else{
                        $availableStatus = "Adopted";
                        echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                            <div class='w3-display-container'>
                                <div class='w3-display-topleft w3-red w3-padding'>$eachDog->name, $availableStatus</div>
                                <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' style='width:280px; height:280px; id='img$counter'> </a>
                            </div>
                        </div>";
                    }
                    
                        $counter += 1;
                }
            ?>
        </div>

    </div>
    
<?php
printErrors();
?>

<!-- End page content -->
</div>

</body>
</html>