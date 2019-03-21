<?php

require_once "include/common.php";

if(isset($_SESSION["breed"])){
    unset($_SESSION["breed"]);
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
      <form action="http:www.google.com" target="_blank">
        <input class="w3-input w3-border" type="text" placeholder="Application ID" required>
        <button class="w3-button w3-black w3-section" type="submit">
            SUBMIT <i class="fa fa-paper-plane"></i>
        </button>
      </form>
    </div>
    
<?php
printErrors();
?>

<!-- End page content -->
</div>

</body>
</html>