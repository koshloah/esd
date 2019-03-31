<?php

require_once "include/common.php";
require_once "include/servicesURL.php";

if(isset($_SESSION["breed"])){
    unset($_SESSION["breed"]);
}
$application_Status = "";
$submitButtonPressed = "";
if(isset($_REQUEST["submitBtn"])){
  $submitButtonPressed = "yes";
  if(isset($_REQUEST["applicationID"])){
    $applicationID = $_REQUEST["applicationID"];
    $url = $getDogAdoptionApplicationURL.$applicationID;
    $json = file_get_contents($url);
    $data = json_decode($json);
    if(!empty($data)){
      $application_Status = $data->application_Status;
      $dogID = $data->dogID;

      if(!empty($dogID)){
        $url = $dogManagementGetDogURL.$dogID;
        $json = file_get_contents($url);
        $data = json_decode($json);
  
        if($data != false){
            $dogName = $data->name;
            $dogPic = $data->pic1;  
        }
      }
      
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
<div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

<div class="w3-container" id="appplication_status" style="margin-top:30px;">

  <!-- Application Status Section -->
  <div class="w3-container" id="appplication_status">
    <h1 class="w3-border-bottom w3-border-light-grey w3-padding-16"><b>Check Application Status</b></h1>
    <p>Enter your application ID to check the application status</p>
    <form action="adoptionstatus.php" method="POST">
      <input class="w3-input w3-border" type="text" name = "applicationID" placeholder="Application ID" value="<?php if(isset($_REQUEST["applicationID"])){ echo $_REQUEST["applicationID"]; }?>" required>
      <button class="w3-button w3-black w3-section" name="submitBtn" type="submit">
          SUBMIT <i class="fa fa-paper-plane"></i>
      </button>
    </form>
    <?php
      if($application_Status != ""){
        if($application_Status == "Approved"){
          echo "<p style='margin-top:-20px;'><h4><b>Congratulations!</b> Your Adoption Application: $applicationID for $dogName has been <b>$application_Status</b>.</h4></p>
                <p><h4>You will be contacted to complete the remaining adoption process of $dogName shortly.</h4></p>
                <p><img src=$dogPic height='300' width='300' style='border-radius: 15px; object-fit: cover;'></p>
                <div class='fb-share-button' 
                  data-href='$dogPic' 
                  data-layout='button' data-size='large'>
                </div>
                
                <br><br>";
                // <blockquote class='twitter-tweet'><p lang='en' dir='ltr'>Sunsets don&#39;t get much better than this one over <a href='https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw'>@GrandTetonNPS</a>. <a href='https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw'>#nature</a> <a href='https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw'>#sunset</a> <a href='http://t.co/YuKy2rcjyU'>pic.twitter.com/YuKy2rcjyU</a></p>&mdash; US Department of the Interior (@Interior) <a href='https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw'>May 5, 2014</a></blockquote> <script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>
                
                // <a href='$dogPic' class='twitter-share-button' data-show-count='false'>Tweet</a><script async src='$dogPic' charset='utf-8'></script>
        }
        else if($application_Status == "Rejected"){
          echo "<p style='margin-top:-20px;'><h4>Unfortunately, your Adoption Application: $applicationID for $dogName has been <b>$application_Status</b>.</h4><h4>Check out the other dogs available for adoption <a href='adopt-view.php'><b><u>here</u></b></a>.</h4></p>
                <p><img src='images/rejected.gif' height='300' width='300' style='border-radius: 15px; object-fit: cover;'></p>";
        }
        else if($application_Status == "Pending"){
          echo "<p style='margin-top:-20px;'><h4>Your Adoption Application: $applicationID for $dogName is <b>$application_Status</b>.</h4><h4>A notification will be sent to your Telegram once there is an outcome.</h4></p>";
        }
        
      }
      else if($submitButtonPressed == "yes"){
        echo "<p style='margin-top:-20px;'><h4><span style='font-size: 1em; color: red;'><i class='fas fa-times-circle'></i></span> Adoption Application: $applicationID <b>does not exist</b>.</h4></p>";
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