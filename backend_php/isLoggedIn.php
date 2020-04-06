<?php
    include "redirectLinks.php";

    session_start();
    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        print $loginPageLink;
    } else {
        print "LOGGED IN";
    }
?>
