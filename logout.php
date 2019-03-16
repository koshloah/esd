<?php
require_once "include/common.php";

// Log out the user!
var_dump($_SESSION);
if(isset($_SESSION["firstName"])){
    unset($_SESSION["firstName"]);
    header("Location: index.php");
    exit;
}
?>