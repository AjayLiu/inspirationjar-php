<?php
    include "setup_connection.php";
    session_start();    
    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        $_SESSION['redir'] = "http://localhost/index.php";
        print "NOT LOGGED IN";
    } else {
        if (isset($_POST['action'])) {
            $email = $_SESSION['payload']['email'];
            $action = $_POST['action'];
            if(strpos($_POST['action'],'good') !== false){

                //GETS THE ID OF THE QUOTE
                $btnId = substr($_POST['action'], strpos($_POST['action'],'d') + 1);
                
                //GET LIKE HISTORY FROM THIS ACCOUNT
                $sql = "SELECT Likes FROM accounts WHERE Email = '$email';";
                $result = $mysqli->query($sql) or die("ouch, error");                                 
                $prevLikes = $result->fetch_assoc()['Likes'];

                //SEE IF IT IS ALREADY LIKED
                if(strpos($prevLikes, $btnId.',') === false){
                    //UNIQUE LIKE

                    //ADD TO LIKE HISTORY
                    $sql = "UPDATE accounts SET Likes = CONCAT('$prevLikes', '$btnId,') WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error"); 
                
                    //ADD ONE LIKE TO THE QUOTE
                    $sql = "UPDATE happy_table SET HappyRating = HappyRating + 1 WHERE HappyID = $btnId;";
                    $result = $mysqli->query($sql) or die("ouch, error");  
                }
                
                               
                
            } else {
                //GETS THE ID OF THE QUOTE
                $btnId = substr($_POST['action'], strpos($_POST['action'],'d') + 1);
                
                //GET DISLIKE HISTORY FROM THIS ACCOUNT
                $sql = "SELECT Dislikes FROM accounts WHERE Email = '$email';";
                $result = $mysqli->query($sql) or die("ouch, error");                                 
                $prevDislikes = $result->fetch_assoc()['Dislikes'];

                //SEE IF IT IS ALREADY DISLIKED
                if(strpos($prevDislikes, $btnId.',') === false){
                    //UNIQUE DISLIKE

                    //ADD TO DISLIKE HISTORY
                    $sql = "UPDATE accounts SET Dislikes = CONCAT('$prevDislikes', '$btnId,') WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error"); 
                
                    //ADD ONE DISLIKE TO THE QUOTE
                    $sql = "UPDATE happy_table SET HappyRating = HappyRating - 1 WHERE HappyID = $btnId;";
                    $result = $mysqli->query($sql) or die("ouch, error");  
                }
            }
        }
        print "LOGGED IN";
    }
?>
