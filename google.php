<?php 
    include "redirectLinks.php";
    require ("vendor/autoload.php");
    session_start();

    //Step 1: Enter you google account credentials
    $g_client = new Google_Client();

    $g_client->setClientId("549099927731-c1aqlvs43ftmc88t3b22t3eg6b4q2hgl.apps.googleusercontent.com");
    $g_client->setClientSecret("wJPhdVv5EwFRNEY1Pl7EOhAH");
    $g_client->setRedirectUri("$afterLoginLink");
    $g_client->setScopes("email");
    $g_client->setApprovalPrompt('force');

    //Step 2 : Create the url
    $auth_url = $g_client->createAuthUrl();

    echo "<a href='$auth_url'> <img src = 'images/btn_google_signin_dark_pressed_web@2x.png' width = 191px height = 46px /></a>";

    //Step 3 : Get the authorization  code
    $code = isset($_GET['code']) ? $_GET['code'] : NULL;

    //Step 4: Get access token
    if(isset($code)) {

        try {

            $token = $g_client->fetchAccessTokenWithAuthCode($code);
            $g_client->setAccessToken($token);

        }catch (Exception $e){
            echo $e->getMessage();
        }

        try {
            $pay_load = $g_client->verifyIdToken();
        }catch (Exception $e) { 
            echo $e->getMessage();
        }

    } else{
        $pay_load = null;
    }

    $_SESSION['payload'] = $pay_load;

?>