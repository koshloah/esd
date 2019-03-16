<!DOCTYPE html>
<html>
<title>Adogtion</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="index.php" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
</div>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

<div class="w3-container w3-padding-32" id="login">
<h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Login</h3>
<p>Login to access content.</p>
<form action="login.php" method="post">
    <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
    <input class="w3-input w3-section w3-border" type="password" placeholder="Password" required name="password">
    <input class="w3-button w3-black w3-section" type="submit" name="submitBtn">
</form>
</div>

<?php
session_start();
//var_dump($_SESSION);
if(isset($_SESSION['errormsg'])){
    print "<ul style='color:red;'>";
    
    foreach ($_SESSION['errormsg'] as $value) {
        print "<li>" . $value . "</li>";
    }
    
    print "</ul>";   
    unset($_SESSION['errormsg']);
}    
?>

<!-- End page content -->
</div>

<!-- Footer -->
<!--<footer class="w3-center w3-black w3-padding-3" style="height:23px;">
  <p>Powered by <a href="#" title="" target="_blank" class="w3-hover-text-green">ESD G1T6</a></p>
</footer>-->
</body>
</html>