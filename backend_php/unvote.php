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
        $likeOrDislike = $_POST['likeOrDislike'];

        //GETS THE ID OF THE QUOTE
        $btnId = $_POST['deleteID'];
        //CHECK IF BTNID IS A NUMBER
        if(is_numeric($btnId) && $btnId > 0 && $btnId == round($btnId, 0)){
            if($likeOrDislike == "like"){
                //GET LIKE HISTORY FROM THIS ACCOUNT
                $sql = "SELECT Likes FROM accounts WHERE Email = '$email';";
                $result = $mysqli->query($sql) or die("ouch, error");
                $prevLikes = $result->fetch_assoc()['Likes'];

                if(strpos($prevLikes, $btnId.',') !== false){
                    //REMOVE FROM LIKE HISTORY
                    $newLikes = str_replace($btnId.',', '', $prevLikes);
                    $sql = "UPDATE accounts SET Likes = '$newLikes' WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error");

                    //UNDO LIKE ON THE QUOTE
                    $sql = "UPDATE happy_table SET HappyRating = HappyRating - 1 WHERE HappyID = $btnId;";
                    $result = $mysqli->query($sql) or die("ouch, error");

                    echo "SUCCESS";
                } else {
                    echo "CANT DELETE, NOT FOUND IN YOUR LIKES HISTORY";
                }
            } else if ($likeOrDislike == "dislike"){
                //GET Dislike HISTORY FROM THIS ACCOUNT
                $sql = "SELECT Dislikes FROM accounts WHERE Email = '$email';";
                $result = $mysqli->query($sql) or die("ouch, error");
                $prevDislikes = $result->fetch_assoc()['Dislikes'];

                if(strpos($prevDislikes, $btnId.',') !== false){
                    //REMOVE FROM LIKE HISTORY
                    $newDislikes = str_replace($btnId.',', '', $prevDislikes);
                    $sql = "UPDATE accounts SET Dislikes = '$newDislikes' WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error");

                    //UNDO DISLIKE ON THE QUOTE
                    $sql = "UPDATE happy_table SET HappyRating = HappyRating + 1 WHERE HappyID = $btnId;";
                    $result = $mysqli->query($sql) or die("ouch, error");

                    echo "SUCCESS";
                } else {
                    echo "CANT DELETE, NOT FOUND IN YOUR Dislikes HISTORY";
                }
            }
        }
    }
?>
