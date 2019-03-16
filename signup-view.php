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

    <div class="w3-container" id="appplication_status" style="margin-top:40px;">
        <h1>User Registration</h1>
        <form action="signup.php" method="POST">
            <table>
                <tr>
                    <td>First Name:</td>
                    <td><input class="w3-input w3-border" type="text" name="firstName" required></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input class="w3-input w3-border" type="text" name="lastName" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input class="w3-input w3-border" type="text" name="email" required></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input class="w3-input w3-border" type="text" name="phone" required></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input class="w3-input w3-border" type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <select class="w3-input w3-border" name='role'>
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>
            </table>
            <button class="w3-button w3-black w3-section" type="submit">Submit</button>
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

</body>
</html>