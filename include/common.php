<?php

// this will autoload the class that we need in our code
spl_autoload_register(function($class) {
 
    // we are assuming that it is in the same directory as common.php
    // otherwise we have to do
    // $path = 'path/to/' . $class . ".php"    
    $path =  $class . ".php";
    require $path; 
  
});


// session related stuff
session_start();


function printErrors() {
    //var_dump($_SESSION);
    if(isset($_SESSION['errormsg'])){
        print "<ul style='color:red;'>";
        
        foreach ($_SESSION['errormsg'] as $value) {
            print "<li>" . $value . "</li>";
        }
        
        print "</ul>";   
        unset($_SESSION['errormsg']);
    }    
}

?>



<title>Adogtion</title>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
        <a href="home.php" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
        <!-- <a class="w3-bar-item">Welcome, <?php echo $_SESSION['firstName'].".";?></a> -->
            <div class="w3-right w3-hide-small">
                <a href="adopt-view.php" class="w3-bar-item w3-button">ADOPT</a>
                <a href="adoptionstatus.php" class="w3-bar-item w3-button">ADOPTION STATUS</a>
                <!--<a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>-->
                <!-- <div class="w3-dropdown-hover w3-hide-small">
                    <a class="w3-button" title="More">APPLY <i class="fa fa-caret-down"></i></a>     
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="#" class="w3-bar-item w3-button">New Application</a>
                    <a href="#appplication_status" class="w3-bar-item w3-button">Check Application</a>
                    </div>
                </div> -->
                <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small">ABOUT</a> -->
                <a href="logout.php" class="w3-bar-item w3-button w3-hide-small">LOGOUT</a>
            </div>
        <!--<a href="javascript:void(0)" class="w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>-->
    </div>
</div>