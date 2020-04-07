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

        if (isset($_POST['action'])) {
            $email = $_SESSION['payload']['email'];
            $action = $_POST['action'];


            //GET LIKE HISTORY FROM THIS ACCOUNT
            $sql = "SELECT Likes FROM accounts WHERE Email = '$email';";
            $result = $mysqli->query($sql) or die("ouch, error");
            $prevLikes = $result->fetch_assoc()['Likes'];

            //GET DISLIKE HISTORY FROM THIS ACCOUNT
            $sql = "SELECT Dislikes FROM accounts WHERE Email = '$email';";
            $result = $mysqli->query($sql) or die("ouch, error");
            $prevDislikes = $result->fetch_assoc()['Dislikes'];

            //GETS THE ID OF THE QUOTE
            $btnId = substr($_POST['action'], strpos($_POST['action'],'d') + 1);

            //SEE IF IT IS ALREADY LIKED OR DISLIKED
            if(strpos($prevLikes, $btnId.',') === false && strpos($prevDislikes, $btnId.',') === false){

                //THIS IS A UNIQUE VOTE


                if(strpos($_POST['action'],'good') !== false){

                    //ADD TO LIKE HISTORY
                    $sql = "UPDATE accounts SET Likes = CONCAT('$prevLikes', '$btnId,') WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error");

                    //ADD ONE LIKE TO THE QUOTE
                    $sql = "UPDATE happy_table SET HappyRating = HappyRating + 1 WHERE HappyID = $btnId;";
                    $result = $mysqli->query($sql) or die("ouch, error");

                } else {
                    //ADD TO DISLIKE HISTORY
                    $sql = "UPDATE accounts SET Dislikes = CONCAT('$prevDislikes', '$btnId,') WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error");

                    //ADD ONE DISLIKE TO THE QUOTE
                    $sql = "UPDATE happy_table SET HappyRating = HappyRating - 1 WHERE HappyID = $btnId;";
                    $result = $mysqli->query($sql) or die("ouch, error");
                }
            } else {
                $toReturn = "DUPE";
            }
        }
    }

    print $toReturn;
?>
