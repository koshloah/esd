<?php
require_once "include/common.php";

if(isset($_REQUEST["transactionID"])){
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $address = $_SESSION["address"];
    $postalCode = $_SESSION["postalCode"];
    $email = $_SESSION["email"];
    $phoneNumber = $_SESSION["phoneNumber"];
    $reason = $_SESSION["reason"];
    $dogID = $_SESSION["dogID"];
    $transactionID = $_REQUEST["transactionID"];

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'http://LAPTOP-LYJK:8081/newadoptionapplication');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"ApplicationID\": \"$transactionID\",  \n   \"firstName\": \"$firstName\",  \n   \"lastName\": \"$lastName\",  \n   \"address\": \"$address\",  \n   \"postalCode\": \"$postalCode\",  \n   \"email\": \"$email\",  \n   \"phoneNo\": \"$phoneNumber\",  \n   \"reason\": \"$reason\",  \n   \"dogID\": \"$dogID\",  \n   \"application_Status\": \"pending\",  \n   \"payment_Status\": \"paid\"  \n }");
    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Accept: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
}

?>
<html>
<body>

    <!-- <input type="text" id="firstName" value="<?php echo $firstName; ?>" readonly><br>
    <input type="text" id="lastName" value="<?php echo $lastName; ?>" readonly><br>
    <input type="text" id="address" value="<?php echo $address; ?>" readonly><br>
    <input type="text" id="postalCode" value="<?php echo $postalCode; ?>" readonly><br>
    <input type="text" id="email" value="<?php echo $email; ?>" readonly><br>
    <input type="text" id="phoneNumber" value="<?php echo $phoneNumber; ?>" readonly><br>
    <input type="text" id="reason" value="<?php echo $reason; ?>" readonly><br>
    <input type="text" id="dogID" value="<?php echo $dogID; ?>" readonly><br>
    <input type="text" id="ApplicationID" value="<?php echo $transactionID; ?>" readonly><br> -->

</body>
</html>
