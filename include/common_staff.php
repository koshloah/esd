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



<title>Adogtion - Staff</title>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>