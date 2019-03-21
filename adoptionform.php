<?php

require_once "include/common.php";

$dogID = "";

if(isset($_REQUEST["submitBtn"])){
    if(isset($_REQUEST["dogID"])){
        $dogID = $_REQUEST["dogID"];
    }
}

?>

<!DOCTYPE html>
<html>
<body>

<div class="w3-container" style="margin-top:60px;">


    <img src='images/load2.gif' height="300" width="300" alt="Image 1" style="border-radius: 15%;">
    <h1>ADOPTION SERVICE IN PROGRESS</h1>
    <hr>
    <p>
    what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>what do I need?<br>
    
    </p>
    <form action="payment.php" method="post">
        <!-- <img src=<?php echo $dogPic2?> height="300" width="300" alt="Image 1" style="border-radius: 15px;"> -->
        <input type="text" name="dogID" value="<?php echo $dogID; ?>" readonly hidden>
        <button class="w3-button w3-black w3-section" type="submit" name="submitBtn">Proceed To Pay <i class="fa fa-paw"></i></button>
    </form>
    


    
<?php
printErrors();
?>

<!-- End page content -->
</div>

</body>
</html>