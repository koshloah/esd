<?php
require_once "include/common.php";
require_once "include/UserDAO.php";

if(isset($_REQUEST["submitBtn"])){
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $errors=[];
    // DAO that interacts with database
    $userdb = new UserDAO();
    $userdetails = $userdb->retrieve($email);
    var_dump($userdetails);
    if($userdetails != false){
        if(password_verify($password,$userdetails->password)){
            $_SESSION["firstName"] = $userdetails->firstName;
            if($userdetails->role == "user"){
                //var_dump($_SESSION);
                header("Location: home.php");
            }
            else if($userdetails->role == "admin"){
                header("Location: staffhome.html");
            }
        }
        else{
            $errors[] = "Invalid Email/Password!";
            $_SESSION["errormsg"] = $errors;
            header("Location: index.php");
        }
    }
    else{
        $errors[] = "Invalid Email/Password!";
        $_SESSION["errormsg"] = $errors;
        header("Location: index.php");
    }
}
?>