<?php 
require_once "include/common.php";

//var_dump($_SESSION);
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
<body onload="getImages();">

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
  <div class="w3-container" id="appplication_status">
      <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Check Application Status</h3>
      <p>Enter your application ID to check application status</p>
      <form action="http:www.google.com" target="_blank">
        <input class="w3-input w3-border" type="text" placeholder="Application ID" required>
        <button class="w3-button w3-black w3-section" type="submit">
          <i class="fa fa-paper-plane"></i> SUBMIT
        </button>
      </form>
    </div>

  <!-- Newly Listed Section -->
  <div class="w3-container" id="newly_listed">
    <h3 class="w3-border-bottom w3-border-light-grey">Newly Listed</h3>
  </div>

  <div class="w3-row-padding">
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
      </div>
    </div>
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
