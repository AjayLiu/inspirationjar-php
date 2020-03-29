<?php
    session_start();    
    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        print "NOT LOGGED IN";
    } else {
        print "LOGGED IN";
    }
?>