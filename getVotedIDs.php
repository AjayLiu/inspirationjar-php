<?php
    include "setup_connection.php";
    session_start();
    

    //CHECK IF LOGGED IN
    if(!isset($_SESSION['payload'])){
        //NOT LOGGED IN
    } else {

        //GET LIKE HISTORY FROM THIS ACCOUNT
        $email = $_SESSION['payload']['email'];
        
        $sql = "SELECT Likes, Dislikes FROM accounts WHERE Email = '$email';";
        $result = $mysqli->query($sql) or die("ouch, error");            
        $likesAndDislikes = $result->fetch_assoc();
        $likesAndDislikesStr = $likesAndDislikes['Likes'].$likesAndDislikes['Dislikes'];
        $likesAndDislikesStr = substr($likesAndDislikesStr, 0, strlen($likesAndDislikesStr)-1); //REMOVE TRAILING COMMA

        //Change into array
        $arr = explode(",","$likesAndDislikesStr");
        
        echo json_encode($arr);
    }

    
?>
