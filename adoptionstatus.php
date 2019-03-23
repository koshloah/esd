<?php

require_once "include/common.php";

if(isset($_SESSION["breed"])){
    unset($_SESSION["breed"]);
}
$application_Status = "";
$submitButtonPressed = "";
if(isset($_REQUEST["submitBtn"])){
  $submitButtonPressed = "yes";
  if(isset($_REQUEST["applicationID"])){
    $applicationID = $_REQUEST["applicationID"];
    $url = "http://laptop-lyjk:8081/getadoptionapplication/".$applicationID;
    $json = file_get_contents($url);
    $data = json_decode($json);
    if(!empty($data)){
      $application_Status = $data->application_Status;
    }

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
    <form action="adoptionstatus.php" method="POST">
      <input class="w3-input w3-border" type="text" name = "applicationID" placeholder="Application ID" required>
      <button class="w3-button w3-black w3-section" name="submitBtn" type="submit">
          SUBMIT <i class="fa fa-paper-plane"></i>
      </button>
    </form>
    <?php
      if($application_Status != ""){
        echo "Your adoption application is: <b>$application_Status</b>.";
      }
      else if($submitButtonPressed == "yes"){
        echo "<b>Application ID does not exist.</b>";
      }
    ?>
  </div>

<?php
printErrors();
?>

<!-- End page content -->
</div>

</body>
</html>