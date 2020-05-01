<?php
    include "setup_connection.php";
    include "redirectLinks.php";

    session_start();

    $email = $_SESSION['payload']['email'];

    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        $_SESSION['redir'] = "$indexLink";
        echo $loginPageLink;
    } else {
        //GET FAVE HISTORY FROM THIS ACCOUNT
        $sql = "SELECT Favorites FROM accounts WHERE Email = '$email';";
        $result = $mysqli->query($sql) or die("ouch, error");
        $prevFaves = $result->fetch_assoc()['Favorites'];

        //GETS THE ID OF THE QUOTE
        $btnId = $_POST['unfavoriteID'];
        if(is_numeric($btnId) && $btnId > 0 && $btnId == round($btnId, 0)){
            if(strpos($prevFaves, $btnId.',') !== false){
                //REMOVE FROM FAVE HISTORY
                $newFave = str_replace($btnId.',', '', $prevFaves);
                $sql = "UPDATE accounts SET Favorites = '$newFave' WHERE Email = '$email'";
                $result = $mysqli->query($sql) or die("ouch, error");
                echo "SUCCESS";
            } else {
                echo "CANT DELETE, NOT FOUND IN YOUR FAVORITES HISTORY";
            }
        }
    }
?>
