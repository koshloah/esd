<?php 
require_once "include/common.php";

$url = "https://dog-api.kinduff.com/api/facts";
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


?>

<!DOCTYPE html>
<html>
<!--<title>Adogtion</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
// jQuery library
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>-->

<!-- <body onload="getImages();"> -->
<body>
<!-- Navbar -->
<!--<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
      <a href="home.html" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
      <div class="w3-right w3-hide-small">
      <a href="#" class="w3-bar-item w3-button">SEARCH</a>-->
      <!--<a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>-->
      <!--<div class="w3-dropdown-hover w3-hide-small">
        <button class="w3-button" title="More">A D O P T <i class="fa fa-caret-down"></i></button>     
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="#appplication_status" class="w3-bar-item w3-button">Applications</a>
          <a href="signup-view.php" class="w3-bar-item w3-button">Temp Sign-up Link</a>
        </div>
      </div>
      <a href="#" class="w3-bar-item w3-button w3-hide-small">ABOUT</a>
      </div>-->
      <!--<a href="javascript:void(0)" class="w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>-->
    <!--</div>
  </div>-->


<!-- Header -->
<header class="w3-display-container w3-content w3-wide w3-center" style="max-width:1500px;" id="home">
  <img class="w3-center" src="images/home2.jpg" width="100%" height="700px">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-hide-small w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b><i class="fas fa-dog"></i></b> A<b>dog</b>tion <i class="fas fa-home"></i></span></h1></span>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

    <!-- Application Status Section -->
  <!-- <div class="w3-container" id="appplication_status">
      <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Check Application Status</h3>
      <p>Enter your application ID to check application status</p>
      <form action="http:www.google.com" target="_blank">
        <input class="w3-input w3-border" type="text" placeholder="Application ID" required>
        <button class="w3-button w3-black w3-section" type="submit">
          <i class="fa fa-paper-plane"></i> SUBMIT
        </button>
      </form>
    </div> -->

  <!-- Available Dogs Section -->
  <div class="w3-container" id="">
    <h3 class="w3-border-bottom w3-border-light-grey"><b>Available Dogs</b></h3>
  </div>

  <!-- <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Jun Wei</div>
        <img src="images/load2.gif" alt="House" style="width:100%; height:200px;" id="img1"> 
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Ben</div>
        <img src="images/load2.gif" alt="House" style="width:100%; height:200px;" id="img2">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Josh</div>
        <img src="images/load2.gif" alt="House" style="width:100%; height:200px;" id="img3">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Xuesi</div>
        <img src="images/load2.gif" alt="House" style="width:100%; height:200px;" id="img4">
        <a class="w3-right" href="adopt-view.php">VIEW MORE</a>
      </div>
    </div>
  </div> -->

  <div class="w3-row-padding">
    <?php
      $counter = 1;
      $availableStatus = "";
      $availableDogArray = [];
      

      foreach ($allDogs as $eachDog){
        if($eachDog->status == "A"){
          $availableDogArray[] = $eachDog;
          // $availableStatus = "Available";
          // echo "<div class='w3-col l3 m6 w3-margin-bottom'>
          //     <div class='w3-display-container'>
          //         <div class='w3-display-topleft w3-green w3-padding'>$eachDog->name, $availableStatus</div>
          //         <a href='viewdog.php?dogid=$eachDog->id'><img src='$eachDog->pic1' style='width:280px; height:280px; id='img$counter'> </a>
          //     </div>
          // </div>";
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
        if(count($availableDogArray) == 4){
          break;
        }
      }

      foreach($availableDogArray as $eachAvailableDog){
        $availableStatus = "Available";
        echo "<div class='w3-col l3 m6 w3-margin-bottom'>
            <div class='w3-display-container'>
                <div class='w3-display-bottomleft w3-green w3-padding'>$eachAvailableDog->name, $availableStatus</div>
                <a href='viewdog2.php?dogid=$eachAvailableDog->id'><img src='$eachAvailableDog->pic1' style='width:100%; height:280px; '></a>
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

  <!--<div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Jun Wei</div>
        <img src="images/home.jpg" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Ben</div>
        <img src="images/home.jpg" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Josh</div>
        <img src="images/home.jpg" alt="House" style="width:99%">
      </div>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding">Xuesi</div>
        <img src="images/home.jpg" alt="House" style="width:99%">
      </div>
    </div>
  </div>-->
<!-- End page content -->
</div>


<script>

  //window.onload = getImages();

  function getImages(){

    $.when(
      $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
            img1 = result;
      }),
      $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
            img2 = result;
      }),
      $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
            img3 = result;
      }),
      $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
            img4 = result;
      })
    ).then(function() {

      document.getElementById("img1").src= img1.message;
      document.getElementById("img2").src= img2.message;
      document.getElementById("img3").src= img3.message;
      document.getElementById("img4").src= img4.message;

    });

    // //ajax
    // $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
    //   if(result.status == "error"){
    //       noResult();
    //     }
    //     else if(result.status == "success"){
    //       loadImages(result);
    //     }
    // });
    // $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
    //   if(result.status == "error"){
    //       noResult();
    //     }
    //     else if(result.status == "success"){
    //       loadImages2(result);
    //     }
    // });
    // $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
    //   if(result.status == "error"){
    //       noResult();
    //     }
    //     else if(result.status == "success"){
    //       loadImages3(result);
    //     }
    // });
    // $.get( "https://dog.ceo/api/breeds/image/random", function( result ) {
    //   if(result.status == "error"){
    //       noResult();
    //     }
    //     else if(result.status == "success"){
    //       loadImages4(result);
    //     }
    // });
    
  }
  
	
		
	// function noResult(){
	// 	//do something
	// }
	  
	// function loadImages(result){
	//   console.log(result.message); 
	// 	document.getElementById("img1").src= result.message;
  // }
  
  // function loadImages2(result){
	//   console.log(result.message); 
	// 	document.getElementById("img2").src= result.message;
  // }
  
  // function loadImages3(result){
	//   console.log(result.message); 
	// 	document.getElementById("img3").src= result.message;
  // }
  
  // function loadImages4(result){
	//   console.log(result.message); 
	// 	document.getElementById("img4").src= result.message;
	// }
	  
</script>

<!-- Footer -->
<!--<footer class="w3-center w3-black w3-padding-3" style="height:23px;">
  <p>Powered by <a href="#" title="" target="_blank" class="w3-hover-text-green">ESD G1T6</a></p>
</footer>-->
</body>
</html>
