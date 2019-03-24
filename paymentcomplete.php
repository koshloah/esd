<?php
require_once "include/common.php";

$firstName = "";
$lastName = "";
$address = "";
$postalCode = "";
$email = "";
$phoneNumber = "";
$reason = "";
$dogID = "";
$transactionID = "";

$telegramChatID = "";
$telegramID = "";
$displayMessage = "";

if(isset($_REQUEST["subscribeBtn"])){
    if(isset($_REQUEST["email"]) && isset($_REQUEST["telegramID"]) && isset($_REQUEST["transactionID"])){
        $email = $_REQUEST["email"];
        $telegramID = $_REQUEST["telegramID"];
        $transactionID = $_REQUEST["transactionID"];

        if(!empty($transactionID)){
            $url = "https://api.telegram.org/bot875776528:AAEpUJaLS8FhzpehL8JLlTCmgsghhUgTOic/getUpdates";
            $json = file_get_contents($url);
            $data = json_decode($json);

            if($data != false){
                $firststdClassObject = get_object_vars($data);
                foreach($firststdClassObject["result"] as $eachresult){
                    $secondstdClassObject = get_object_vars($eachresult);
                    $thirdstdClassObject = get_object_vars($secondstdClassObject["message"]);
                    $fourthstdClassObject = get_object_vars($thirdstdClassObject["from"]);
                    if($fourthstdClassObject["username"] == $telegramID){
                        $telegramChatID = $fourthstdClassObject["id"];
                        break;
                        //var_dump($fourthstdClassObject["id"]);
                        //var_dump($fourthstdClassObject["username"]);
                    }
                    else{
                        $displayMessage = "<b>Subscription unsuccessful</b>, ensure you have completed <b>Step 1</b> - <b>Step 2</b>, and entered a <b>valid</b> Telegram ID.";
                    }
                }

                if(!empty($telegramChatID)){
                    //echo $telegramChatID;
                    $message = "You have successfully subscribed to Adogtion's Notification Service. Your Adoption Application ID is: $transactionID";
                    $telegramurl = "https://api.telegram.org/bot875776528:AAEpUJaLS8FhzpehL8JLlTCmgsghhUgTOic/sendMessage";
                    $telegramurl .= "?chat_id=$telegramChatID";
                    $telegramurl .= "&text=$message";

                    $telegramResponse = file_get_contents($telegramurl);
                    $decodedTelegramResponse = json_decode($telegramResponse);
                    
                    $displayMessage = "<b>Subscription successful</b>, a confirmation message has been sent to <b>@$telegramID</b> on Telegram.";
                    //header("Location: $url");
                    //var_dump($decodedTelegramResponse);
                }

            } 
        }
        else{
            $displayMessage = "Because you refreshed the page, the transaction ID is gone.";
            //header("Location: logout.php");
        }
           
    }

}
else{
    if(isset($_REQUEST["transactionID"])){

        if(isset($_SESSION["firstName"]) && isset($_SESSION["lastName"]) && isset($_SESSION["address"]) && isset($_SESSION["postalCode"]) 
            && isset($_SESSION["email"]) && isset($_SESSION["phoneNumber"]) && isset($_SESSION["reason"]) && isset($_SESSION["dogID"]) && isset($_REQUEST["transactionID"])){
            
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
                // $formattedResult = (string)$result;
                // if(strpos( $formattedResult , 'Duplicate entry' ) !== false){
                //     $returnMessage = true;
                // }
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                curl_close ($ch);

                unset($_SESSION["firstName"]);
                unset($_SESSION["lastName"]);
                unset($_SESSION["address"]);
                unset($_SESSION["postalCode"]);
                unset($_SESSION["email"]);
                unset($_SESSION["phoneNumber"]);
                unset($_SESSION["reason"]);
                unset($_SESSION["dogID"]);
        }
        else{
            header("Location: logout.php");
        }
        
    
        
    }
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
    <div class="w3-container" style="margin-top:40px;">
        <h1>Transaction Successful</h1>

        <p>Adoption Application ID: <b><?php echo $transactionID; ?></b></p>
        You can check the status of your adoption application using this Adoption Application ID <a href="adoptionstatus.php"><u><b>here</b></u></a>.
        <hr>
        Alternatively, if you wish to be notified of the adoption application outcome through our notification services, follow these steps:
        <br>
        <br>
        <span class="w3-tag w3-black">Step 1</span> 
        <div class="w3-container w3-white">
            <p>Subscribe to our Telegram notification service(@Outcome_notification_bot) <a href="https://telegram.me/Outcome_notification_bot" target="_blank"><u><b>here</b></u></a>.</p>
        </div>
        <span class="w3-tag w3-black">Step 2</span> 
        <div class="w3-container w3-white">
            <p>Press <b>/start</b>.</p>
        </div>
        <span class="w3-tag w3-black">Step 3</span> 
        <div class="w3-container w3-white">
            <form action="paymentcomplete.php" method="POST">
                <p>Enter your Email and Telegram ID below to get notified of the outcome of your adoption application.</p>
                <p><input class="w3-input w3-border" type="text" placeholder="Enter email" name="email" style="width: 25%" value="<?php if(!empty($email)){ echo $email;}?>" required></p>
                <p><input class="w3-input w3-border" type="text" placeholder="Enter Telegram ID" name="telegramID" style="width: 20%" value="<?php if(!empty($telegramID)){ echo $telegramID;}?>" required></p>
                <p><button class="w3-button w3-black" type="submit" name="subscribeBtn">Submit <i class="fa fa-paper-plane"></i></button></p>
                <p><input class="w3-input w3-border" type="hidden" name="transactionID" style="width: 20%" <?php if(isset($_REQUEST["transactionID"])){echo "value='$transactionID'";} ?>></p>
            </form>
            <p style="margin-bottom:25px;"><?php echo $displayMessage; ?></p>
        </div>
        <!-- Subscribe -->
        <!-- <div class="w3-white w3-margin">
            <div class="w3-container w3-padding w3-black">
            <h4>Subscribe</h4>
            </div>
            <div class="w3-container w3-white">
            <p>Enter your Email and Telegram ID below and get notified on the outcome of your adoption application.</p>
            <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
            <p><button type="button" onclick="document.getElementById('subscribe').style.display='block'" class="w3-button w3-block w3-red">Subscribe</button></p>
            </div>
        </div> -->


        <!-- <p class="w3-right"><button class="w3-button w3-black"><b>Replies  </b> <span class="w3-tag w3-white">1</span></button></p> -->
    </div>

</body>
</html>
