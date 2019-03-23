<?php
    session_start();

    echo "
    <html>
        <head>
            <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        </head>
        <body>
            <div style='text-align:center'>
                <div class='w3-display w3-margin-top w3-center'>
                    <h1 class='w3-xxlarge w3-text'><span class='w3-hide-small w3-text-'><span class='w3-padding w3-white w3-opacity-min'><b><i class='fas fa-dog'></i></b> A<b>dog</b>tion <i class='fas fa-home'></i></span></h1></span>
                </div>

                <img src='images/load2.gif' height='250' width='250' style='border-radius: 50%;'>
                <h4>Please wait while we redirect you to a secure payment site.</h4>
            </div>
        </body>
    </html>";

    //var_dump($_REQUEST);
    $readyToProceed = "no";
    if(isset($_REQUEST["adoptBtn"])){
        if(isset($_REQUEST["firstName"]) && isset($_REQUEST["lastName"]) && isset($_REQUEST["address"]) && isset($_REQUEST["postalCode"]) 
            && isset($_REQUEST["email"]) && isset($_REQUEST["phoneNumber"]) && isset($_REQUEST["reason"]) && isset($_REQUEST["dogID"])){
            
            $_SESSION["firstName"] = $_REQUEST["firstName"];
            $_SESSION["lastName"] = $_REQUEST["lastName"];
            $_SESSION["address"] = $_REQUEST["address"];
            $_SESSION["postalCode"] = $_REQUEST["postalCode"];
            $_SESSION["email"] = $_REQUEST["email"];
            $_SESSION["phoneNumber"] = $_REQUEST["phoneNumber"];
            $_SESSION["reason"] = $_REQUEST["reason"];
            $_SESSION["dogID"] = $_REQUEST["dogID"];
            
            $readyToProceed = "yes";
        } 
    }



    /*$url = "http://localhost/esd/home.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_URL,$url);
    echo curl_exec($ch);
    curl_close($ch);*/

    /* paypal CURL syntax
    curl https://api-3t.sandbox.paypal.com/nvp \
    -s \
    --insecure \
    -d USER YourUserID \
    -d PWD YourPassword \
    -d SIGNATURE YourSignature \
    -d METHOD=SetExpressCheckout \
    -d VERSION=98 \
    -d PAYMENTREQUEST_0_AMT=10 \
    -d PAYMENTREQUEST_0_CURRENCYCODE=USD \
    -d PAYMENTREQUEST_0_PAYMENTACTION=SALE \
    -d cancelUrl=https://example.com/cancel \
    -d returnUrl=https://example.com/success */

    $cost = 2000;

    if(isset($_GET['PayerID']) && isset($_GET['token'])){
        $payerid = urlencode($_GET['PayerID']);
        $token = urlencode($_GET['token']);
        
        $baseurl = 'https://api-3t.sandbox.paypal.com/nvp'; //sandbox
        //$baseurl = 'https://api-3t.paypal.com/nvp'; //live
        $username = urlencode('esdg1t6_api1.gmail.com');
        $password = urlencode('KC23C5EBXBXDZBR3');
        $signature = urlencode('AO2poBy4MdVpK3od9pT9zvRySJOPAY6eR7RekDkLXMQuXxzPM12EJr8t');
        $post[] = "USER=$username";
        $post[] = "PWD=$password";
        $post[] = "SIGNATURE=$signature";
        $post[] = "VERSION=65.1";
        $post[] = "PAYMENTREQUEST_0_CURRENCYCODE=SGD";
        $post[] = "PAYMENTREQUEST_0_AMT=$cost";
        $post[] = "PAYMENTREQUEST_0_ITEMAMT=$cost";
        $post[] = "PAYMENTREQUEST_0_PAYMENTACTION=Sale";
        $post[] = "L_PAYMENTREQUEST_0_NAME0=Adoption%20Application%20Fee"; // use %20 for spaces
        $post[] = "L_PAYMENTREQUEST_0_ITEMCATEGORY0=Digital";
        $post[] = "L_PAYMENTREQUEST_0_QTY0=1";
        $post[] = "L_PAYMENTREQUEST_0_AMT0=$cost";
        $post['method'] = "METHOD=DoExpressCheckoutPayment";
        $post['token'] = "TOKEN=$token";
        $post['payerid'] = "PayerID=$payerid";
        $post_str = implode('&',$post);
        $output_str = CurlMePost($baseurl,$post_str);
        parse_str($output_str,$output_array);

        $transactionid = $output_array['PAYMENTINFO_0_TRANSACTIONID'];

        // echo $transactionid;
        // echo "<pre>";
        // var_dump($output_array);
        // echo "</pre>";
        
        header("Location: paymentcomplete.php?transactionID=$transactionid");
    }
    else{
        $baseurl = 'https://api-3t.sandbox.paypal.com/nvp'; //sandbox
        //$baseurl = 'https://api-3t.paypal.com/nvp'; //live
        $username = urlencode('esdg1t6_api1.gmail.com');
        $password = urlencode('KC23C5EBXBXDZBR3');
        $signature = urlencode('AO2poBy4MdVpK3od9pT9zvRySJOPAY6eR7RekDkLXMQuXxzPM12EJr8t');
        $returnurl = urlencode('http://localhost/esd/payment.php'); // where the user is sent upon successful completion
        $cancelurl = urlencode('http://localhost/esd/logout.php'); // where the user is sent upon canceling the transaction
        $post[] = "USER=$username";
        $post[] = "PWD=$password";
        $post[] = "SIGNATURE=$signature";
        $post[] = "VERSION=65.1"; // very important!
        $post[] = "PAYMENTREQUEST_0_CURRENCYCODE=SGD"; 
        $post[] = "PAYMENTREQUEST_0_AMT=$cost";
        $post[] = "PAYMENTREQUEST_0_ITEMAMT=$cost";
        $post[] = "PAYMENTREQUEST_0_PAYMENTACTION=Sale"; // do not alter
        $post[] = "L_PAYMENTREQUEST_0_NAME0=Adoption%20Application%20Fee"; // use %20 for spaces
        $post[] = "L_PAYMENTREQUEST_0_ITEMCATEGORY0=Digital"; // do not alter
        $post[] = "L_PAYMENTREQUEST_0_QTY0=1";
        $post[] = "L_PAYMENTREQUEST_0_AMT0=$cost";
        $post['returnurl'] = "RETURNURL=$returnurl"; // do not alter
        $post['cancelurl'] = "CANCELURL=$cancelurl"; // do not alter
        $post['method'] = "METHOD=SetExpressCheckout"; // do not alter
        
        $post_str = implode('&',$post);
        $output_str = CurlMePost($baseurl,$post_str);
        parse_str($output_str,$output_array);
        $ack = $output_array['ACK'];
        $token = (!empty($output_array['TOKEN'])) ? $output_array['TOKEN'] : '';
        //echo $token."<br>";
        //echo $ack."<br>";
        $redirecturl = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=$token"; //sandbox

        //echo $redirecturl."<br>";;
        if($readyToProceed == "yes"){
            header("refresh:1; url=$redirecturl");
        }
        

        //$redirecturl = "https://www.paypal.com/incontext?token=$token"; //live
    }
 
    function CurlMePost($url,$post){ 
        // $post is a URL encoded string of variable-value pairs separated by &
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $post); 
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3); // 3 seconds to connect
        curl_setopt ($ch, CURLOPT_TIMEOUT, 10); // 10 seconds to complete
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
?>
