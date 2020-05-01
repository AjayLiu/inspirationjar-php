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

            //GETS THE ID OF THE QUOTE
            $btnId = substr($action, strpos($action,'d') + 1);

            //CHECK IF BTNID IS A NUMBER
            if(is_numeric($btnId) && $btnId > 0 && $btnId == round($btnId, 0)){


                //GET LIKE AND Dislike HISTORY FROM THIS ACCOUNT
                $sql = "SELECT Likes, Dislikes FROM accounts WHERE Email = '$email';";
                $result = $mysqli->query($sql) or die("ouch, error");
                $row = $result->fetch_assoc();
                $prevLikes = $row['Likes'];
                $prevDislikes = $row['Dislikes'];



                //SEE IF IT IS ALREADY LIKED OR DISLIKED
                if(strpos($prevLikes, $btnId.',') === false && strpos($prevDislikes, $btnId.',') === false){

                    //THIS IS A UNIQUE VOTE
                    if(strpos($action,'good') !== false){

                        //ADD TO LIKE HISTORY
                        $sql = "UPDATE accounts SET Likes = CONCAT('$prevLikes', '$btnId,') WHERE Email = '$email'";
                        $result = $mysqli->query($sql) or die("ouch, error");

                        //ADD ONE LIKE TO THE QUOTE
                        $sql = "UPDATE happy_table SET HappyRating = HappyRating + 1 WHERE HappyID = $btnId;";
                        $result = $mysqli->query($sql) or die("ouch, error");

                    } else if (strpos($action,'bad') !== false){
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
    }

    print $toReturn;
?>
