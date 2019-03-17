<?php
require_once "include/common.php";

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
    echo $dogID;

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
                $dogAltered = $eachDog->altered;
                $dogHasShots = $eachDog->hasShots;
                $dogHouseTrained = $eachDog->houseTrained;
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
    <link rel="stylesheet" href="viewdogcss.css">
    <style>
    .previous {
    background-color: #f1f1f1;
    color: black;
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
    }

    .next {
    background-color: #f1f1f1;
    color: black;
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
    }

    .previous:hover{
        background-color: #ddd;
        color: black; 
    }

    .next:hover{
        background-color: #ddd;
        color: black; 
    }
    </style>
</head>
<body>

<div class="w3-container" id="appplication_status" style="margin-top:0px;">
    <div class="w3-container w3-padding-32" id="about">
        <div id="gallerywrapper">
            <div id="gallery">
                <div id="pic1">
                    <img src=<?php echo $dogPic1?> height="350" width="500" alt="Image 1">
                    <!-- <a class="previous" href="#pic5">&lt;</a>
                    <a class="next" href="#pic2">&gt;</a> -->
                    <div style = "margin-top:0px;">
                        <a href="#pic2" class="previous">&laquo; Previous</a>
                        <a href="#pic2" class="next">Next &raquo;</a>
                    </div>
                    <!-- <h1><?php echo $dogName; ?></h1> -->
                    <!--<p>Text of image 1.</p>-->
                </div>
                <div id="pic2">
                    <img src=<?php echo $dogPic2?> height="350" width="500" alt="Image 2">
                    <div style = "margin-top:0px;">
                        <a href="#pic1" class="previous">&laquo; Previous</a>
                        <a href="#pic1" class="next">Next &raquo;</a>
                    </div>
                    <!-- <h1><?php echo $dogName; ?></h1> -->
                    <!--<p>Text of image 2.</p>-->
                </div>
            </div>
        </div>
        <!-- <h1 class="w3-border-bottom w3-border-light-grey w3-padding-16"><?php echo $dogName; ?></h1> -->
        <table id="tableDisplay">
            <tr>
                <td colspan='2'><h1><b><?php echo $dogName; ?></b></h1></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Age Category:</b></td>
                <td><?php echo $dogAge; ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Breed:</b></td>
                <td><?php echo $dogBreed; ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Size:</b></td>
                <td><?php echo $dogSize; ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Gender:</b></td>
                <td><?php echo $dogSex; ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Availability:</b></td>
                <td><?php if($dogStatus == "A"){echo "Available";}else{echo "Adopted";} ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Altered:</b></td>
                <td><?php echo $dogAltered; ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>Vaccinated:</b></td>
                <td><?php echo $dogHasShots; ?></td>
            </tr>
            <tr>
                <td style="width:150px;"><b>House Trained:</b></td>
                <td><?php echo $dogHouseTrained; ?></td>
            </tr>
            <tr>
                <td colspan='2'><?php echo $dogDescription; ?></td>
            </tr>
            <tr>
                <td><button class="w3-button w3-black w3-section" type="submit" name="submitBtn">Adopt</button></td>
            </tr>
           
        </table>
            

    </div>








<!-- End page content -->
</div>

</body>
</html>