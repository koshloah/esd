<?php
require_once "include/common_staff.php";
require_once "include/servicesURL.php";

//var_dump($_REQUEST);

if(isset($_REQUEST["submitBtn"])){
    if(isset($_REQUEST["selectedDogID"]) && isset($_REQUEST["selectedStatus"])){
        $dogID = $_REQUEST["selectedDogID"];
        $selectedStatus = $_REQUEST["selectedStatus"];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $dogManagementUpdateDogStatusURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"id\": $dogID  \n }");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);

        if(isset($_SESSION["dogList"])){
            unset($_SESSION["dogList"]);
        }
        $_SESSION["resetSessionVariable"] = true;

        var_dump($_SESSION);
        //var_dump($result);
        header("Location: updateDogs.php");
    }
}

?>