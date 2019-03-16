<?php

require_once "include/common.php";
require_once "include/UserDAO.php";

if(isset($_REQUEST["firstName"]) && isset($_REQUEST["lastName"]) && isset($_REQUEST["email"]) && isset($_REQUEST["phone"]) && isset($_REQUEST["password"])){
    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $email = $_REQUEST["email"];
    $phone = $_REQUEST["phone"];
    $password = $_REQUEST["password"];
    $role = $_REQUEST["role"];
    $userdb = new UserDAO();
    
    $errors = []; // will contain error messages

    // Check for empty fields
    if($firstName == ""){
        $errors[]="First Name is empty";
    }
    if($lastName == ""){
        $errors[]="Last Name is empty";
    }
    if($email == ""){
        $errors[]="Email is empty";
    }

    if($phone == ""){
        $errors[]="Phone is empty";
    }

    if($password == ""){
        $errors[]="Password is empty";
    }

    if($userdb->retrieve($email)!=null){
        $errors[]="Email is already in use";
    }

    if(count($errors)>0){
        $_SESSION["errormsg"] = $errors;
        header("Location: signup-view.php");
    }
    else{
        //database insert
        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($firstName,$lastName,$email,$phone,$hashedpwd,$role);
        $insertresult = $userdb->add($user);
        if($insertresult){
            echo "Book has been added";
            header("Location: home.php");
            exit;
        }
        else{
            $errors[]="Something went wrong, cannot add to database";
            $_SESSION["errormsg"] = $errors;
            header("Location: home.php");
            exit;
        }
    }
}


?>