<?php
require_once "include/common_staff.php";
require_once "include/servicesURL.php";

if(isset($_REQUEST["appID"])){
    $redirectedFrom = $_REQUEST["from"]; 

    $url = $getDogAdoptionApplicationURL.$_REQUEST["appID"];
    $json = file_get_contents($url);
    $data = json_decode($json);

    if($data != false){
        
        $ApplicationID = $data->ApplicationID;
        $firstName = $data->firstName;
        $lastName = $data->lastName;
        $address = $data->address;
        $postalCode = $data->postalCode;
        $email = $data->email;
        $phoneNo = $data->phoneNo;
        $reason = $data->reason;
        $dogID = $data->dogID;
        $application_Status = $data->application_Status;
        
        $url = $dogManagementGetDogURL.$dogID;
        $json = file_get_contents($url);
        $data = json_decode($json);

        if($data != false){
            $dogName = $data->name;
            $dogPic = $data->pic1;  
        }

    }
    else{
        header("Location: staffhome.php");
    }

}

if(isset($_REQUEST["submitBtn"])){
    if(isset($_REQUEST["selectedApplicationID"]) && isset($_REQUEST["selectedStatus"])){
        $selectedApplicationID = $_REQUEST["selectedApplicationID"];
        $selectedStatus = $_REQUEST["selectedStatus"];
        
        // if approved, approve selected application and reject the rest that applied for the same dog
        if($selectedStatus == "Approved"){
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $updateDogAdoptionApplication2URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"ApplicationID\": \"$selectedApplicationID\",  \n   \"application_Status\": \"$selectedStatus\",  \n   \"payment_Status\": \"Approved\"  \n }");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            
            
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);
        }
        else if($selectedStatus == "Pending" || $selectedStatus == "Rejected"){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $updateDogAdoptionApplicationURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{  \n   \"ApplicationID\": \"$selectedApplicationID\",  \n   \"application_Status\": \"$selectedStatus\",  \n   \"payment_Status\": \"Approved\"  \n }");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close ($ch);
        }
        
        var_dump($result);

        if($_REQUEST["redirectedFrom"]=="home"){
            header("Location: staffhome.php");
        }
        else if($_REQUEST["redirectedFrom"]=="approved"){
            header("Location: approvedApplications.php");
        }
        else if($_REQUEST["redirectedFrom"]=="rejected"){
            header("Location: rejectedApplications.php");
        }
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

            <!-- <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16"><b>Application ID: <?php echo $ApplicationID; ?></b></h3> -->


				<h2 class="about-left editContent" data-selector=".editContent" style=""><b>Application ID: </b><?php echo $ApplicationID; ?></b></h2>
				<hr style="border: 1px solid black;">
                <h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Address:</b><?php echo $address; ?></b></h4>
				<h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Postal Code: </b><?php echo $postalCode; ?></b></h4>
                <h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Email: </b><?php echo $email; ?></b></h4>
                <h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Phone Number: </b><?php echo $phoneNo; ?></b></h4>
                <h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Application Status: </b><?php echo ucfirst($application_Status); ?></b></h4>
                <h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Application For: </b><?php echo $dogName; ?></b></h4>
                <h4 class="mt-sm-4 mt-3 editContent" data-selector=".editContent" style=""><b>Reason: </b><br><?php echo $reason; ?></b></h4>
                <hr style="border: 1px solid black;">
                <form action="staff_view_application.php" method="POST">
                    <table>
                        <tr>
                            <td><h4><b>Set Application Status To:  </b></h4></td>
                            <td>
                                <select name="selectedStatus" class="form-control form-control-sm">
                                    <option <?php if($redirectedFrom == "approved"){ echo "selected";}?>>Approved</option>
                                    <option <?php if($redirectedFrom == "rejected"){ echo "selected";}?>>Rejected</option>
                                    <option <?php if($redirectedFrom == "home"){ echo "selected";}?>>Pending</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <button class="w3-button w3-black w3-round-medium" name="submitBtn" type="submit">Submit</button>
                    <input type="hidden" name="selectedApplicationID" value="<?php echo $ApplicationID; ?>">
                    <input type="hidden" name="redirectedFrom" value="<?php echo $redirectedFrom; ?>">
                </form>
			</div>
			<div class="col-lg-4 col-md-8">
                    <img src=<?php echo $dogPic?> class="img-fluid w3-right" height="300px" width="350px" data-selector="img" style="margin:10px; border-radius: 4%; object-fit: cover;">
                
			</div>
		</div>
	</div>
    <?php
    printErrors();
    ?>
</body>
</html>