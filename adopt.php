<?php
require_once "include/common.php";
require_once "include/DogDAO.php";

//var_dump($_REQUEST);
if(isset($_REQUEST["breed"])){
    $breed = $_REQUEST["breed"];
    $errors=[];
    // DAO that interacts with database
    $dogdb = new DogDAO();

    if($breed == ""){
        $breed = "All";
    }
    $dogBreeds = $dogdb->retrieve($breed);

    //var_dump($breed);
    //var_dump($dogBreeds);
    if($dogBreeds != false){
        $_SESSION["dogList"] = $dogBreeds;
        $_SESSION["selectedDogBreed"] = $breed;
        header("Location: adopt-view.php");
    }
    else{
        $errors[] = "Unable to get dogs!";
        //var_dump($errors);
        $_SESSION["errormsg"] = $errors;
        //header("Location: adopt-view.php");
    }
}
?>