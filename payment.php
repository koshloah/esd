<?php

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

        echo $transactionid;
        echo "<pre>";
        var_dump($output_array);
        echo "</pre>";
        
        //header("Location: paymentcomplete.php?transactionID=$transactionid");
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
        echo $token."<br>";
        echo $ack."<br>";
        $redirecturl = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=$token"; //sandbox

        echo $redirecturl."<br>";;
        header("Location: $redirecturl");

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
