<?php
    include "setup_connection.php";
    session_start();


    //CHECK IF LOGGED IN
    if(!isset($_SESSION['payload'])){
        //NOT LOGGED IN
    } else {

        //GET FAVE HISTORY FROM THIS ACCOUNT
        $email = $_SESSION['payload']['email'];

        $sql = "SELECT Favorites FROM accounts WHERE Email = '$email';";
        $result = $mysqli->query($sql) or die("ouch, error");
        $faves = $result->fetch_assoc()['Favorites'];
        echo $faves;
    }


?>
