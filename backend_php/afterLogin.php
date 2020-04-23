<?php
    include "setup_connection.php";
    include "redirectLinks.php";

    include "../google.php";

    session_start();
    
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
        }

        //REMEMBER
        if(!isset($_SESSION['remember']) || isset($_SESSION['remember']) && $_SESSION['remember'] == 'true'){
            $sessionID = uniqid('', true);
            $sql = "INSERT INTO sessions (session_id, email) VALUES ('$sessionID', '$email')";
            $result = $mysqli->query($sql) or die("ouch, died here");

            //MAKE SESSION COOKIE
            setcookie("session", $sessionID, mktime (0, 0, 0, 12, 31, 2021));
            setcookie("session", $sessionID, mktime (0, 0, 0, 12, 31, 2021), "/", $siteName);

        }

    }

    $url = $_SESSION['redir'];
    header("Location: $url");

?>
