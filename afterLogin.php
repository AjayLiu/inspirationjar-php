<?php 
    include "setup_connection.php";
    include "google.php";
    $payload = $_SESSION['payload'];
    $email = $payload['email'];

    if(isset($email)){
        
        //ADD ACCOUNT TO DATABASE IF NEW
        $sql = "SELECT Email FROM accounts WHERE Email = '$email'";
        $result = $mysqli->query($sql) or die("ouch, error");  
        
        //EMAIL DOESNT EXIST (NEW)
        if($result->fetch_assoc()['Email'] == null){
            $sql = "INSERT INTO accounts (Email) VALUES ('$email')";
            $result = $mysqli->query($sql) or die("ouch, error");    
            
            
            $sessionID = uniqid('', true);
            $sql = "INSERT INTO sessions (session_id, email) VALUES ('$sessionID', '$email')";
            $result = $mysqli->query($sql) or die("ouch, died here");  
            
            setcookie("session", $sessionID, mktime (0, 0, 0, 12, 31, 2021));
        }
        

    } 

    $url = $_SESSION['redir'];
    header("Location: $url");
?>