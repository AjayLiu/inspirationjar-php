<?php
    $isLocal = false;

    $siteName = $isLocal ? "localhost" : "inspirationjar.com";
    $http = $isLocal ? "http://" : "http://www.";
    $submitLink = $http.$siteName."/submit.php";
    $loginPageLink =  $http.$siteName."/login_page.php";
    $afterLoginLink =  $http.$siteName."/backend_php/afterLogin.php";
    $indexLink =  $http.$siteName."/index.php";
    $accountLink =  $http.$siteName."/myaccount.php";

?>
