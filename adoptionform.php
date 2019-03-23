<?php

require_once "include/common.php";

$dogID = "";

if(isset($_REQUEST["submitBtn"])){
    if(isset($_REQUEST["dogID"])){
        $dogID = $_REQUEST["dogID"];

        if(isset($_SESSION["dogList"])){
            $dogArray = $_SESSION["dogList"];
            foreach($dogArray as $eachDog){
                if($eachDog->id == $dogID){
                    $dogName = $eachDog->name;
                    $dogPic = $eachDog->pic1;
                }
            }
        }
        else{
            header("Location: adopt-view.php");
        }
    }
}



?>

<!DOCTYPE html>
<html>
<body>

<div class="w3-container" style="margin-top:60px;">


    <!-- <img src='images/load2.gif' height="250" width="250" alt="Image 1" style="border-radius: 50%;"> -->
    <img src=<?php echo $dogPic;?> height="250" width="250" alt="Image 1" style="border-radius: 50%;">
    <h2><?php echo $dogName . "'s"; ?> Adoption Form</h2>
    <hr>
    <form action="payment.php" method="post">
        <b>First Name:</b>
        <input class="w3-input w3-border" type="text" id="firstName" name="firstName" style="width:20%" required>
        <br>
        <b>Last Name:</b>
        <input class="w3-input w3-border" type="text" id="lastName" name="lastName" style="width:20%" required>
        <br>
        <b>Address:</b>
        <textarea rows="3" cols="40" class="w3-input w3-border" type="text" id="address" name="address" style="width:30%" required></textarea>
        <br>
        <b>Postal Code:</b>
        <input class="w3-input w3-border" type="text" id="postalCode" name="postalCode" style="width:15%" required>
        <br>
        <b>Email:</b>
        <input class="w3-input w3-border" type="text" id="email" name="email" style="width:25%" required>
        <br>
        <b>Phone Number:</b>
        <input class="w3-input w3-border" type="text" id="phoneNumber" name="phoneNumber" style="width:20%" required>
        <br>
        <b>Why do you want to adopt <?php echo $dogName; ?>?</b>
        <textarea rows="7" cols="50" class="w3-input w3-border" id="reason" name="reason" placeholder="Reason" style="width:100%" required></textarea>
        <p><b>Note:</b> To ensure our dogs are not adopted on impulse, a non-refundable application fee of <b>$2000.00</b> will be imposed.</p>
        
        <button class="w3-button w3-black" type="submit" name="adoptBtn">Proceed To Pay <i class="fa fa-paw"></i></button>

        <input type="text" name="dogID" value="<?php echo $dogID; ?>" readonly hidden>
        <a onclick="loadForm()"><u>Generate Form Inputs</u></a>
    </form>
    
    
    
<?php
printErrors();
?>

<!-- End page content -->
</div>

<script>
    function loadForm(){
        document.getElementById("firstName").value = "Adeline";
        document.getElementById("lastName").value = "Tan";
        document.getElementById("address").value = "80 Stamford Rd";
        document.getElementById("postalCode").value = "178902";
        document.getElementById("email").value = "xuesi.sim.2017@smu.edu.sg";
        document.getElementById("phoneNumber").value = "98765432";

        var reason = "Because it is one way to fight puppy mills. If you buy a dog from a pet store,online seller or flea market, you’re almost certainly getting a dog from a puppy mill.";
        // reason += "Puppy mills are factory-style breeding facilities that put profit above the welfare of dogs. Animals from puppy mills are housed in shockingly poor conditions with improper ";
        // reason += "medical care, and are often very sick and behaviorally troubled as a result. The moms of these puppies are kept in cages to be bred over and over for years, without human companionship ";
        // reason += "and with little hope of ever joining a family. And after they're no longer profitable, breeding dogs are simply discarded—either killed, abandoned or sold at auction.";
        // reason += "These puppy mills continue to stay in business through deceptive tactics — their customers are unsuspecting consumers who shop in pet stores, over the Internet or through ";
        // reason += "classified ads. Puppy mills will continue to operate until people stop supporting them. By adopting a pet, you can be certain you aren't giving them a dime.";
        
        document.getElementById("reason").value = reason;




    }

</script>

</body>
</html>