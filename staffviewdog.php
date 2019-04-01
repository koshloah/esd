<?php

require_once "include/common_staff.php";
require_once "include/servicesURL.php";

$dogName = "";
$dogAge = "";
$dogBreed = "";
$dogSize = "";
$dogSex = "";
$dogStatus = "";
$dogAltered = "";
$dogHasShots = "";
$dogHouseTrained = "";
$dogDescription = "";
$dogPic1 = "";
$dogPic2 = "";

if(isset($_REQUEST['dogid'])){
    $dogID = $_REQUEST['dogid'];
    //echo $dogID;

    if(isset($_SESSION["dogList"])){
        $dogArray = $_SESSION["dogList"];
        foreach($dogArray as $eachDog){
            if($eachDog->id == $dogID){
                $dogName = $eachDog->name;
                $dogAge = $eachDog->age;
                $dogBreed = $eachDog->breed;
                $dogSize = $eachDog->size;
                $dogSex = $eachDog->sex;
                $dogStatus = $eachDog->status;
                $dogAltered = ucfirst($eachDog->altered);
                $dogHasShots = ucfirst($eachDog->hasShots);
                $dogHouseTrained = ucfirst($eachDog->houseTrained);
                $dogDescription = $eachDog->description;
                $dogPic1 = $eachDog->pic1;
                $dogPic2 = $eachDog->pic2;
            }
        }
    }
    else{
        header("Location: adopt-view.php");
    }
}
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

<!-- Navbar -->
<div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="staffhome.php" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
            <!-- <a class="w3-bar-item">Welcome, <?php echo $_SESSION['firstName'].".";?></a> -->
                <div class="w3-right w3-hide-small">
                    <a href="updateDogs.php" class="w3-bar-item w3-button">UPDATE DOGS</a>
                    <!-- <a href="staffhome.php" class="w3-bar-item w3-button">PENDING</a>
                    <a href="approvedApplications.php" class="w3-bar-item w3-button">APPROVED</a>
                    <a href="rejectedApplications.php" class="w3-bar-item w3-button">REJECTED</a> -->
                    <!--<a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>
                    <a href="#" class="w3-bar-item w3-button w3-hide-small">Adopt</a>-->
                    <div class="w3-dropdown-hover w3-hide-small">
                        <a class="w3-button w3-white" title="More">APPLICATIONS <i class="fa fa-caret-down"></i></a>     
                        <div class="w3-dropdown-content w3-bar-block w3-card-4">
                            <a href="staffhome.php" class="w3-bar-item w3-button">PENDING</a>
                            <a href="approvedApplications.php" class="w3-bar-item w3-button">APPROVED</a>
                            <a href="rejectedApplications.php" class="w3-bar-item w3-button">REJECTED</a>
                        </div>
                    </div>
                    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small">ABOUT</a> -->
                    <a href="staffhome.php" class="w3-bar-item w3-button w3-hide-small">LOGOUT</a>
                </div>
            <!--<a href="javascript:void(0)" class="w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>-->
        </div>
    </div>




<div class="container py-md-3" style="margin-top: 60px;">
		<!-- <h2 class="heading text-center mb-sm-5 mb-4 editContent" data-selector=".editContent" style="">About Us </h2> -->
		<div class="row w3-round-large" style="background-color: #d4eaff;">
			<div class="col-lg-8">
				<h2 class="about-left editContent" data-selector=".editContent" style=""><i class="fa fa-paw"></i><?php echo " $dogName (ID: $dogID)"; ?></h2>
                <hr style="border: 1px solid black;">
				<p class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b><?php echo "$dogDescription"; ?></b></p>
                <hr style="border: 1px solid black;">
				<div class="row mt-4">
					<div class="col-md-3 col-6">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="outline: none; cursor: inherit;">
								<span class="fas fa-address-card" data-selector="span.fa" style="outline: none; cursor: inherit; font-size:20px"> Age: </span>
                                <!-- <span class="fa-stack fa-lg">
                                <i class="fa fa-camera fa-stack-1x"></i>
                                <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                </span> -->
                                
                                <!-- <img src='images/age.svg' class="img-fluid w3-right" width='50px' height='50px' data-selector="img" style="margin:10px; border-radius: 4%;"> -->
                            </span>
                            
							<h5 class="editContent" data-selector=".editContent" style="outline: none; cursor: inherit;"><b><?php echo $dogAge; ?></b></h5>
						</div>
					</div>
					<div class="col-md-3 col-6">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="outline: none; cursor: inherit;">
								<span class="fas fa-dog" data-selector="span.fa" style="outline: none; cursor: inherit; font-size:20px"> Breed:</span>
							</span>
							<h5 class="editContent" data-selector=".editContent" style=""><b><?php echo $dogBreed; ?></b></h5>
						</div>
					</div>
					<!-- .about-box ends here -->
					<div class="col-md-3 col-6 mt-md-0 mt-4">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="outline: none; cursor: inherit;">
								<span class="fas fa-arrows-alt-h" data-selector="span.fa" style="outline: none; cursor: inherit; font-size:20px"> Size:</span>
							</span>
							<h5 class="editContent" data-selector=".editContent" style="outline: none; cursor: inherit;"><b><?php echo $dogSize; ?></b></h5>
						</div>
					</div>
					<div class="col-md-3 col-6 mt-md-0 mt-4">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="">
								<span class="fas fa-venus-mars" data-selector="span.fa" style="font-size:20px"> Gender:</span>
							</span>
							<h5 class="editContent" data-selector=".editContent" style="outline: none; cursor: inherit;"><b><?php echo $dogSex; ?></b></h5>
						</div>
					</div>
				</div>
                <div class="row mt-4">
					<div class="col-md-3 col-6">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="outline: none; cursor: inherit;">
								<span class="fas fa-clipboard-check" data-selector="span.fa" style="outline: none; cursor: inherit; font-size:20px"> Availability: </span>
                                <!-- <img src='images/age.svg' class="img-fluid w3-right" width='50px' height='50px' data-selector="img" style="margin:10px; border-radius: 4%;"> -->
                            </span>
							<h5 class="editContent" data-selector=".editContent" style="outline: none; cursor: inherit;"><b><?php if($dogStatus == "A"){echo "Available";}else{echo "Not Available";} ?></b></h5>
						</div>
					</div>
					<div class="col-md-3 col-6">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="outline: none; cursor: inherit;">
								<span class="fas fa-clinic-medical" data-selector="span.fa" style="outline: none; cursor: inherit; font-size:20px"> Altered: </span>
							</span>
							<h5 class="editContent" data-selector=".editContent" style=""><b><?php echo $dogAltered; ?></b></h5>
						</div>
					</div>
					<!-- .about-box ends here -->
					<div class="col-md-3 col-6 mt-md-0 mt-4">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="outline: none; cursor: inherit;">
								<span class="fas fa-syringe" data-selector="span.fa" style="outline: none; cursor: inherit; font-size:20px"> Vaccinated:</span>
							</span>
							<h5 class="editContent" data-selector=".editContent" style="outline: none; cursor: inherit;"><b><?php echo $dogHasShots; ?></b></h5>
						</div>
					</div>
					<div class="col-md-3 col-6 mt-md-0 mt-4">
						<div class="about-box">
							<span class="icon editContent" data-selector=".editContent" style="">
								<span class="fas fa-home" data-selector="span.fa" style="font-size:20px"> House Trained:</span>
							</span>
							<h5 class="editContent" data-selector=".editContent" style="outline: none; cursor: inherit;"><b><?php echo $dogHouseTrained; ?></b></h5>
						</div>
					</div>
				</div>
				<form action="staffUpdateDogs.php" method="POST">
                    <table>
                        <tr>
                            <td><h4><b>Status: </b></h4></td>
                            <td>
                                <select name="selectedStatus" class="form-control form-control-sm">
                                    <option>Not Available</option>
                                    <option>Available</option>
                                </select>
                            </td>
                        </tr>
                    </table>
					<br>
                    <button class="w3-button w3-black w3-round-medium" name="submitBtn" type="submit">Update</button>
                    <input type="hidden" name="selectedDogID" value="<?php echo $dogID; ?>">
                </form>
			</div>
			<div class="col-lg-4 col-md-8">
                    <img src=<?php echo $dogPic1?> class="img-fluid w3-right" height="300px" width="350px" data-selector="img" style="margin:10px; border-radius: 4%; object-fit: cover;">
                
			</div>
		</div>
	</div>
</body>
</html>


