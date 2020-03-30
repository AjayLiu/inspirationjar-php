<?php 
    include "setup_connection.php";
    include "google.php";
    $payload = $_SESSION['payload'];
    $email = $payload['email'];

    if(isset($email)){
        
        //ADD ACCOUNT TO DATABASE IF NEW
        $sql = "SELECT Email FROM accounts WHERE Email = '$email'";
        $result = $mysqli->query($sql) or die("ouch, error");  
        
        //DOESNT EXIST
        if($result->fetch_assoc()['Email'] == null){
            $sql = "INSERT INTO accounts (Email) VALUES ('$email')";
            $result = $mysqli->query($sql) or die("ouch, error");  
        }
        

    } 

    $url = $_SESSION['redir'];
    header("Location: $url");
?>