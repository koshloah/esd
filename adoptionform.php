<?php
require_once "include/common.php";
require_once "include/servicesURL.php";

$dogID = "";
$emailNoDuplicate = "";

//if(isset($_REQUEST["submitBtn"])){
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
//}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://use.fontawesome.com/6bdc8c0524.js"></script>
</head>
<body>
    <div class="container py-md-3" style="margin-top: 60px; margin-bottom:20px;">
		<!-- <h2 class="heading text-center mb-sm-5 mb-4 editContent" data-selector=".editContent" style="">About Us </h2> -->
		<div class="row w3-round-large" style="background-color: #d4eaff;">
			<div class="col-lg-8">



				<h2 class="about-left editContent" data-selector=".editContent" style=""><i class="fa fa-paw"></i><?php echo " $dogName's"; ?> Adoption Form</h2>
                <hr style="border: 1px solid black;">
                <form action="payment.php" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name:</label>
                                <input class="form-control" type="text" id="firstName" name="firstName" style="width:100%" value="<?php if(isset($_SESSION["firstName"])){ echo $_SESSION["firstName"]; }?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name:</label>
                                <input class="form-control" type="text" id="lastName" name="lastName" style="width:100%" value="<?php if(isset($_SESSION["lastName"])){ echo $_SESSION["lastName"]; }?>" required>
                    
                            </div>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea rows="3" cols="40" class="form-control" type="text" id="address" name="address" style="width:100%" required><?php if(isset($_SESSION["address"])){ echo $_SESSION["address"]; }?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="postalCode">Postal Code:</label>
                        <input class="form-control" type="text" id="postalCode" name="postalCode" style="width:100%" value="<?php if(isset($_SESSION["postalCode"])){ echo $_SESSION["postalCode"]; }?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input onchange="emailCheck()" class="form-control" type="text" id="email" name="email" style="width:100%; <?php if(isset($_REQUEST["message"])){ echo 'border:1px solid red !important';} ?>" value="<?php if(isset($_SESSION["email"])){ echo $_SESSION["email"]; }?>" <?php if(isset($_REQUEST["message"])){echo "autofocus";} ?> required>
                        <?php if(isset($_REQUEST["message"])){ echo "<font id='errorMsg' color='red'>An adoption application was submitted by this email.</font><br id='errorMsgBR'>";} ?>
                    </div>


                    <div class="form-group">
                        <label for="lastName">Phone Number:</label>
                        <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" style="width:100%" value="<?php if(isset($_SESSION["phoneNumber"])){ echo $_SESSION["phoneNumber"]; }?>" required>
            
                    </div>

                    <div class="form-group">
                        <label for="reason">State why you want to adopt <?php echo $dogName; ?>?</label>
                        <textarea rows="7" cols="50" class="form-control" id="reason" name="reason" style="width:100%" required><?php if(isset($_SESSION["reason"])){ echo $_SESSION["reason"]; }?></textarea>
                    </div>

                    <hr style="border: 1px solid black;">
                    <p><b>Note:</b> To ensure our dogs are not adopted on impulse, there is a non-refundable adoption application fee of <b>$2000.00</b>.</p>
                    <div style="margin-bottom:10px;">
                        <button class="w3-button w3-black" type="submit" name="adoptBtn">Proceed To Pay <i class="fa fa-paw"></i></button>
                        <input type="text" name="dogID" value="<?php echo $dogID; ?>" readonly hidden>
                        <a onclick="loadForm()"><u>Generate Form Inputs</u></a>
                    </div>
                </form>
			</div>
            


			<div class="col-lg-4 col-md-8">
                <div>
                    <img src=<?php echo $dogPic?> class="img-fluid w3-right" width='350px' height='300px' data-selector="img" style="margin:10px; border-radius: 4%; object-fit: cover;">
                </div>
			</div>
		</div>
        <?php
            printErrors();
        ?>
	</div>

    <script>
        function loadForm(){
            document.getElementById("firstName").value = "Adeline";
            document.getElementById("lastName").value = "Tan";
            document.getElementById("address").value = "80 Stamford Rd";
            document.getElementById("postalCode").value = "178902";
            document.getElementById("email").value = "xuesi.sim.2017@smu.edu.sg";
            document.getElementById("phoneNumber").value = "98765432";

            var reason = "Because it is one way to fight puppy mills. If you buy a dog from a pet store, online seller or flea market, you’re almost certainly getting a dog from a puppy mill.";
            // reason += "Puppy mills are factory-style breeding facilities that put profit above the welfare of dogs. Animals from puppy mills are housed in shockingly poor conditions with improper ";
            // reason += "medical care, and are often very sick and behaviorally troubled as a result. The moms of these puppies are kept in cages to be bred over and over for years, without human companionship ";
            // reason += "and with little hope of ever joining a family. And after they're no longer profitable, breeding dogs are simply discarded—either killed, abandoned or sold at auction.";
            // reason += "These puppy mills continue to stay in business through deceptive tactics — their customers are unsuspecting consumers who shop in pet stores, over the Internet or through ";
            // reason += "classified ads. Puppy mills will continue to operate until people stop supporting them. By adopting a pet, you can be certain you aren't giving them a dime.";
            
            document.getElementById("reason").value = reason;
        }

        function emailCheck(){
            document.getElementById("email").style.border = "1px solid black";
            document.getElementById("errorMsg").style.display = "none";
            document.getElementById("errorMsgBR").style.display = "none";
        }

    </script>

</body>
</html>