<?php
    // echo phpinfo();

    // //post
    // $url="https://www.way2sms.com/api/v1/createSenderId";
    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
    // curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=&secret=&usetype=");// post data
    // // query parameter values must be given without squarebrackets.
    // // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // $result = curl_exec($curl);
    // curl_close($curl);
    // echo var_dump($result);
    // echo "<br/><br/>";

    //post
    $url = "https://www.way2sms.com/api/v1/sendCampaign";
    // urlencode your message
    $message = urlencode("message");

    $curl = curl_init();

    // set post data to true
    curl_setopt($curl, CURLOPT_POST, 1);

    // post data
    // query parameter values must be given without squarebrackets.
    // curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=[povided-api-key]&secret=[provided-secret-key]&usetype=[stage or prod]&phone=[to-mobile]&senderid=[active-sender-id]&message=[$message]");
    $email = "<EMAIL_ID>";
    $key = "<API_KEY>";
    $secret = "<SECRET_KEY>";
    // type is stage for test and prod for live
    $type = "<TYPE>";
    $no = "<PHONE_NO>";
    curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=$key&secret=$secret&usetype=$type&phone=$no&senderid=$email&message=$message");
    
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_VERBOSE, true);
    $info = curl_getinfo($curl);
    var_dump($info);
    echo "<br/><br/>";

    $result = curl_exec($curl);
    curl_close($curl);
    echo var_dump($result);
?>