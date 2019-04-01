<?php
require_once "include/common_staff.php";
if(isset($_REQUEST["breed"])){
    $selectedDogBreed = $_REQUEST["breed"];
    $_SESSION["staff_breed"] = $selectedDogBreed;
    header("Location: updateDogs.php");
}

?>