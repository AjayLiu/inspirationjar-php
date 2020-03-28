<?php
    include "setup_connection.php";
    session_start();    
    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        print "NOT LOGGED IN";
        $_SESSION['redir'] = "http://localhost/index.php";
    } else {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            if(strpos($_POST['action'],'good') !== false){
                $btnId = substr($_POST['action'], strpos($_POST['action'],'d') + 1);
                $sql = "UPDATE happy_table SET HappyRating = HappyRating + 1 WHERE HappyID = $btnId";    
                $result = $mysqli->query($sql) or die("ouch, error"); 
            } else {
                $btnId = substr($_POST['action'], strpos($_POST['action'],'d') + 1); 
                $sql = "UPDATE happy_table SET HappyRating = HappyRating - 1 WHERE HappyID = $btnId";    
                $result = $mysqli->query($sql) or die("ouch, error");
            }
        }
        print "LOGGED IN";
    }
?>
