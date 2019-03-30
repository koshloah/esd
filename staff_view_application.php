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

        }
        
        else if($selectedStatus == "Pending" || $selectedStatus == "Rejected"){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://LAPTOP-LYJK:8081/updateadoptionapplication');
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
<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="staffhome.php" class="w3-bar-item w3-button"><i class="fas fa-dog"></i> A<b>dog</b>tion <i class="fas fa-home"></i></a>
            <!-- <a class="w3-bar-item">Welcome, <?php echo $_SESSION['firstName'].".";?></a> -->
                <div class="w3-right w3-hide-small">
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

    <div class="w3-content w3-padding" style="max-width:1564px">
        <div class="w3-container" style="margin-top: 30px;">
            <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16"><b>Application ID: <?php echo $ApplicationID; ?></b></h3>
        
            <table id="tableDisplay">
                <tr>
                    <td valign="top" style="width:200px; "><b>Applicant's Name:</b></td>
                    <td><?php echo $firstName . " " . $lastName; ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Address:</b></td>
                    <td><?php echo $address; ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Postal Code:</b></td>
                    <td><?php echo $postalCode; ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Email:</b></td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Phone Number:</b></td>
                    <td><?php echo $phoneNo; ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Reason:</b></td>
                    <td><?php echo $reason; ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Application Status:</b></td>
                    <td><?php echo ucfirst($application_Status); ?></td>
                </tr>
                <tr>
                    <td valign="top"><b>Application For:</b></td>
                    <td><?php echo $dogName; ?></td>
                </tr>
                    
            </table>
            <img src=<?php echo $dogPic?> height="300" width="300" style="border-radius: 15px; margin-top:10px;">
            <br>
            <br>
            <form action="staff_view_application.php" method="POST">
                <b>Set Application Status To: </b> 
                <select name="selectedStatus" class="w3-button w3-white w3-border">
                    <option>Approved</option>
                    <option>Rejected</option>
                    <option>Pending</option>
                </select>
                <br>
                <button class="w3-button w3-black w3-section" name="submitBtn" type="submit">Submit</button>
                <input type="hidden" name="selectedApplicationID" value="<?php echo $ApplicationID; ?>">
                <input type="hidden" name="redirectedFrom" value="<?php echo $redirectedFrom; ?>">
            </form>
        </div>
    
    
    <?php
    printErrors();
    ?>

    <!-- End page content -->
    </div>

</body>
</html>