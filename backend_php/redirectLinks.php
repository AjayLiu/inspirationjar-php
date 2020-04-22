<?php
    $isLocal = false;

    $siteName = $isLocal ? "localhost" : "encourageme.herokuapp.com";
    $http = $isLocal ? "http" : "https";
    $submitLink = $http."://".$siteName."/submit.php";
    $loginPageLink =  $http."://".$siteName."/login_page.php";
    $afterLoginLink =  $http."://".$siteName."/backend_php/afterLogin.php";
    $indexLink =  $http."://".$siteName."/index.php";
    $accountLink =  $http."://".$siteName."/myaccount.php";

?>
