<?php

require_once "include/common.php";

if(isset($_SESSION["breed"])){
    unset($_SESSION["breed"]);
}

if(isset($_REQUEST["applicationID"])){
    $applicationID = $_REQUEST["applicationID"];
    $url = "http://laptop-lyjk:8081/getadoptionapplication/".$applicationID;
    $json = file_get_contents($url);
    $data = json_decode($json);
    $application_Status = $data->application_Status;
    /*["ApplicationID"]
    ["firstName"]
    ["lastName"]
    ["address"]
    ["postalCode"]
    ["email"]
    ["phoneNo"]
    ["reason"]
    ["dogID"]
    ["application_Status"]
    ["payment_Status"]
    */
}


?>
<!DOCTYPE html>
<html>
<body>

<div class="w3-container" id="appplication_status" style="margin-top:30px;">

  <!-- Application Status Section -->
  <div class="w3-container" id="appplication_status">
    <h1 class="w3-border-bottom w3-border-light-grey w3-padding-16">Check Application Status</h1>
    <p>Enter your application ID to check application status</p>
    <form action="adoptionstatus.php" method="GET">
      <input class="w3-input w3-border" type="text" name = "applicationID" placeholder="Application ID" required>
      <button class="w3-button w3-black w3-section" type="submit">
          SUBMIT <i class="fa fa-paper-plane"></i>
      </button>
    </form>
    <?php
      if($application_Status != ""){
        echo "Your application outcome is: $application_Status";
      }
    ?>
  </div>
  

  <!-- Subscribe -->
  <!-- <div class="w3-white w3-margin">
    <div class="w3-container w3-padding w3-black">
      <h4>Subscribe</h4>
    </div>
    <div class="w3-container w3-white">
      <p>Enter your e-mail below and get notified on the latest blog posts.</p>
      <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
      <p><button type="button" onclick="document.getElementById('subscribe').style.display='block'" class="w3-button w3-block w3-red">Subscribe</button></p>
    </div>
  </div> -->

<?php
printErrors();
?>

<!-- End page content -->
</div>

</body>
</html>