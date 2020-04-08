<?php
    include "setup_connection.php";
    include "redirectLinks.php";
    include "rememberMe.php";
    session_start();

    $toReturn = "";


    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        $_SESSION['redir'] = "$indexLink";
        $toReturn = $loginPageLink;
    } else {
        $toReturn = "LOGGED IN";

        if (isset($_POST['favID'])) {
            $email = $_SESSION['payload']['email'];

            //GET FAVE HISTORY FROM THIS ACCOUNT
            $sql = "SELECT Favorites FROM accounts WHERE Email = '$email';";
            $result = $mysqli->query($sql) or die("ouch, error");
            $prevFaves = $result->fetch_assoc()['Favorites'];

            //GETS THE ID OF THE QUOTE
            $btnId = $_POST['favID'];

            //TOGGLE FAVORITE

            //if found
            if(strpos($prevFaves, $btnId.',') === false){
                //ADD TO FAVE HISTORY
                $sql = "UPDATE accounts SET Favorites = CONCAT('$prevFaves', '$btnId,') WHERE Email = '$email'";
                $result = $mysqli->query($sql) or die("ouch, error");
            } else {
                //REMOVE FROM FAVE HISTORY
                $newFave = str_replace($btnId.',', '', $prevFaves);
                $sql = "UPDATE accounts SET Favorites = '$newFave' WHERE Email = '$email'";
                $result = $mysqli->query($sql) or die("ouch, error");
            }
        }
    }

    print $toReturn;
?>
