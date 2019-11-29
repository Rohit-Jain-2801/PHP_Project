<?php
    require_once 'vendor/autoload.php';
    
    // init configuration
    $clientID = '<Client-ID>';
    $clientSecret = '<Client-Secret>';
    $redirectUri = '<Redirect-URL>';
    
    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    // $client->setAccessType("offline");
    $client->addScope("email");
    $client->addScope("profile");

    // $auth_url = $client->createAuthUrl();
    // header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
?>