<?php
require_once "include/common.php";
require_once "include/servicesURL.php";

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

$receivedStatus = "no";

if(isset($_REQUEST["subscribeBtn"])){
    // if(isset($_REQUEST["email"]) && isset($_REQUEST["telegramID"]) && isset($_REQUEST["transactionID"])){
    if(isset($_REQUEST["telegramID"]) && isset($_REQUEST["transactionID"])){
        $email = "adogtion123@gmail.com";
        $telegramID = $_REQUEST["telegramID"];
        $transactionID = $_REQUEST["transactionID"];
        $receivedStatus = $_REQUEST["receivedStatus"];

        if(!empty($transactionID) && $receivedStatus == "no"){
            $url = $telegramSubscribersURL;
            $json = file_get_contents($url);
            $data = json_decode($json);

            if($data != false){
                $firststdClassObject = get_object_vars($data);
                foreach($firststdClassObject["result"] as $eachresult){
                    $secondstdClassObject = get_object_vars($eachresult);
                    $thirdstdClassObject = get_object_vars($secondstdClassObject["message"]);
                    $fourthstdClassObject = get_object_vars($thirdstdClassObject["from"]);
                    if(array_key_exists("username",  $fourthstdClassObject)){
                        if($fourthstdClassObject["username"] == $telegramID){
                            $telegramChatID = $fourthstdClassObject["id"];
                            break;
                            //var_dump($fourthstdClassObject["id"]);
                            //var_dump($fourthstdClassObject["username"]);
                        }
                        else{
                            $displayMessage = "<span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span> <b>Subscription unsuccessful</b>, ensure you have completed <b>Step 1</b> - <b>Step 2</b>, and entered a <b>valid</b> Telegram ID.";
                        }
                    }
                    else{
                        $displayMessage = "<span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span> Please set a username for your Telegram account.";
                    }  
                }

                if(!empty($telegramChatID)){
                    //echo $telegramChatID;
                    $message = "You have successfully subscribed to Adogtion's Notification Service. Your Adoption Application ID is: $transactionID";
                    $telegramurl = $telegramMessageURL;
                    $telegramurl .= "?chat_id=$telegramChatID";
                    $telegramurl .= "&text=$message";

                    $telegramResponse = file_get_contents($telegramurl);
                    $decodedTelegramResponse = json_decode($telegramResponse);

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $outcomeNotificationServiceURL);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"application_id\": \"$transactionID\",  \n   \"email\": \"$email\",  \n   \"chat_id\": $telegramChatID,  \n   \"telegram_username\": \"$telegramID\"  \n }");
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
                    
                    $receivedStatus = "yes";

                    $displayMessage = "<span style='font-size: 1em; color: green;'><i class='fas fa-check-circle'></i></span> <b>Subscription successful</b>, a confirmation message has been sent to <b>@$telegramID</b> on Telegram.";
                    //header("Location: $url");
                    //var_dump($decodedTelegramResponse);
                }
                else{
                    $displayMessage = "<span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span> <b>Subscription unsuccessful</b>, ensure you have completed <b>Step 1</b> - <b>Step 2</b>, and entered a <b>valid</b> Telegram ID.";
                    //No recent interaction with the telegram bot
                    //$displayMessage = "No chat IDs available.";
                }

            }
            else{
                $displayMessage = "<span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span> No chat IDs available.";
            } 
        }
        else{
            //$displayMessage = "Because you refreshed the page, the transaction ID is gone/ you have already received a notification.";
            // submission confirmation already sent
            header("Location: logout.php");
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
                
                curl_setopt($ch, CURLOPT_URL, $newDogAdoptionApplicationURL);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"ApplicationID\": \"$transactionID\",  \n   \"firstName\": \"$firstName\",  \n   \"lastName\": \"$lastName\",  \n   \"address\": \"$address\",  \n   \"postalCode\": \"$postalCode\",  \n   \"email\": \"$email\",  \n   \"phoneNo\": \"$phoneNumber\",  \n   \"reason\": \"$reason\",  \n   \"dogID\": \"$dogID\",  \n   \"application_Status\": \"Pending\",  \n   \"payment_Status\": \"Approved\"  \n }");
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
    <div class="w3-container" style="margin-top:50px;">
        <h1>Transaction Successful</h1>

        <p>Adoption Application ID: <b><?php echo $transactionID; ?></b></p>
        You can check the status of your adoption application using this Adoption Application ID <a href="adoptionstatus.php"><u><b>here</b></u></a>.
        <hr>
        Alternatively, if you wish to be notified of the adoption application outcome through our notification service, follow these steps:
        <br>
        <br>
        <span class="w3-tag w3-black">Step 1</span> 
        <div class="w3-container w3-white">
            <p>Subscribe to our Telegram notification service(<?php echo $telegramBotUsername; ?>) <a href=<?php echo $telegramBotURL; ?> target="_blank"><u><b>here</b></u></a>.</p>
            <!-- <p><img src="images/telebotinfo.jpg" height='200px' width='250px'></p> -->
        </div>
        <span class="w3-tag w3-black">Step 2</span> 
        <div class="w3-container w3-white">
            <p>Press <b>/start</b>.</p>
            <!-- <p><img src="images/step2telebotinfo.jpg" height='300px' width='200px'></p> -->
        </div>
        <span class="w3-tag w3-black">Step 3</span> 
        <div class="w3-container w3-white">
            <form action="paymentcomplete.php" method="POST">
                <p>Enter your Telegram Username to get notified of the outcome of your adoption application.</p>
                <!-- <p><input class="w3-input w3-border" type="text" placeholder="Enter email" name="email" style="width: 25%" value="<?php if(!empty($email)){ echo $email;}?>" required></p> -->
                <p><input class="w3-input w3-border" type="text" placeholder="Enter Telegram Username" name="telegramID" style="width: 20%" value="<?php if(!empty($telegramID)){ echo $telegramID;}?>" required></p>
                <p><button class="w3-button w3-black" type="submit" name="subscribeBtn">Submit <i class="fa fa-paper-plane"></i></button></p>
                <p><input class="w3-input w3-border" type="hidden" name="transactionID" style="width: 20%" <?php if(isset($_REQUEST["transactionID"])){echo "value='$transactionID'";} ?>></p>
                <p><input class="w3-input w3-border" type="hidden" name="receivedStatus" style="width: 20%" <?php echo "value='$receivedStatus'"; ?>></p>
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
