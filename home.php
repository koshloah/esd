<?php 
require_once "include/common.php";
require_once "include/servicesURL.php";

$url = $dogFactsURL;
$json = file_get_contents($url);
$data = json_decode($json);

$randomDogFact = "";
if($data != false){
  $randomDogFact = $data->facts[0];
}
else{
  $randomDogFact = "The dog in-charge of facts is currently on vacation, sorry for the inconvenience!";
}

// To retrieve available dogs
$dogBreedStatus = "";
$selectedDogBreed =""; 
$uniqueDogBreeds = [];

if(isset($_SESSION["breed"])){
  unset($_SESSION["breed"]);
}

if(isset($_SESSION["dogList"])){
    $allDogs = $_SESSION["dogList"];
    shuffle($allDogs);
    foreach($allDogs as $eachDog){
        $uniqueDogBreeds[]=$eachDog->breed;
    }
    $dogBreeds = array_unique($uniqueDogBreeds);
    $dogBreedStatus = "success";
}
// retrieve from dog service if session is empty
else{
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
    }
    else{
        header("Location: home.php");
    }
}

?>

<!DOCTYPE html>
<html>
<body>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide w3-center" style="max-width:1500px;" id="home">
  <img class="w3-center" src="images/home2.jpg" width="100%" height="700px">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-hide-small w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b><i class="fas fa-dog"></i></b> A<b>dog</b>tion <i class="fas fa-home"></i></span></h1></span>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Available Dogs Section -->
  <div class="w3-container" id="">
    <h3 class="w3-border-bottom w3-border-light-grey"><b>Available Dogs</b></h3>
  </div>

  <div class="w3-row-padding">
    <?php
      $counter = 1;
      $availableStatus = "";
      $availableDogArray = [];
      

      foreach ($allDogs as $eachDog){
        if($eachDog->status == "A"){
          $availableDogArray[] = $eachDog;
          /*$availableStatus = "Available";
          echo "<div class='w3-col l3 m6 w3-margin-bottom'>
              <div class='w3-display-container'>
                  <div class='w3-display-topleft w3-green w3-padding'>$eachDog->name, $availableStatus</div>
                  <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' style='width:280px; height:280px; id='img$counter'> </a>
              </div>
          </div>";*/
        }
        /*else{
            $availableStatus = "Adopted";
            echo "<div class='w3-col l3 m6 w3-margin-bottom'>
                <div class='w3-display-container'>
                    <div class='w3-display-topleft w3-red w3-padding'>$eachDog->name, $availableStatus</div>
                    <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' style='width:280px; height:280px; id='img$counter'> </a>
                </div>
            </div>";
        }*/
        
        $counter += 1;
        if(count($availableDogArray) == 4){
          break;
        }
      }

      foreach($availableDogArray as $eachAvailableDog){
        $availableStatus = "Available";
        echo "<div class='w3-col l3 m6 w3-margin-bottom'>
            <div class='w3-display-container'>
                <div class='w3-display-bottomleft w3-green w3-padding'>$eachAvailableDog->name, $availableStatus</div>
                <a href='viewdog.php?dogid=$eachAvailableDog->id'><img src='$eachAvailableDog->pic1' class='w3-hover-sepia' style='width:100%; height:280px; border-radius: 4%;'></a>
            </div>
        </div>";
      }
      ?>
      <a class="w3-right" href="adopt-view.php" style="margin-right:7px; margin-top:-10px;">VIEW MORE</a>
    </div>

  <!-- Random dog fact -->
  <div class="w3-container" id="random_dog_facts">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16" style="margin-top:-15px;"><b>Random dog facts</b></h3>
    <h4><?php echo "<b>Did you know? </b>" . $randomDogFact; ?></h4>
    <img src="images/dog2.png" width="600px" height="400px">
  </div>

<!-- End page content -->
</div>
</body>
</html>