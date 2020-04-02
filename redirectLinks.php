<?php

    $isLocal = false;

    if($isLocal){
        $submitLink = "http://localhost/submit.php";
        $loginPageLink = "http://localhost/login_page.php";
        $afterLoginLink = "http://localhost/afterLogin.php";
        $indexLink = "http://localhost/index.php";
        $accountLink = "http://localhost/myaccount.php";
    } else {
        $submitLink = "https://encourageme.herokuapp.com/submit.php";
        $loginPageLink = "https://encourageme.herokuapp.com/login_page.php";
        $afterLoginLink = "https://encourageme.herokuapp.com/afterLogin.php";
        $indexLink = "https://encourageme.herokuapp.com/index.php";
        $accountLink = "https://encourageme.herokuapp.com/myaccount.php";

    }





?>
