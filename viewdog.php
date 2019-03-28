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

                // $url = "https://api.thedogapi.com/v1/breeds/search?q=".$dogBreed;
                // $json = file_get_contents($url);
                // $additionalBreedInfo = json_decode($json);
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
<body>
    <div class="w3-container" style="margin-top:60px;">

        <div class="w3-container">
            <img src=<?php echo $dogPic1?> height="300" width="300" alt="Image 1" style="border-radius: 4%;">
            <hr>
            <table id="tableDisplay" style="margin-top:-30px;">
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

                <?php
                
                    // if(!empty($additionalBreedInfo)){
                    //     foreach($additionalBreedInfo as $eachBreedInfo){
                    //         var_dump($eachBreedInfo);
                    //     }
                    // }
                ?>
                    
            </table>
            <form action="adoptionform.php" method="GET">
                <!-- <img src=<?php echo $dogPic2?> height="300" width="300" alt="Image 1" style="border-radius: 15px;"> -->
                <input type="text" name="dogID" value="<?php echo $dogID; ?>" readonly hidden>
                <button class="w3-button w3-black w3-section" type="submit">Adopt <?php echo $dogName; ?> <i class="fa fa-paw"></i></button>
            </form>
            

        </div>
        
        <?php
        printErrors();
        ?>

    <!-- End page content -->
    </div>

</body>
</html>