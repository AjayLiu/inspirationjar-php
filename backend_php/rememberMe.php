<?php 
    include "setup_connection.php";
    session_start();

    if(isset($_COOKIE['session'])){
        $sql = "SELECT email FROM sessions WHERE session_id = ?";            
        $stmt = mysqli_stmt_init($mysqli);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL ERROR";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $_COOKIE['session']);
            mysqli_stmt_execute($stmt);   
            mysqli_stmt_bind_result($stmt, $c);
            while(mysqli_stmt_fetch($stmt)){
                $savedEmail = $c;
            }

            if(isset($savedEmail)){
                $_SESSION['payload']['email'] = $savedEmail;
                $_SESSION['isLoggedIn'] = true;
            }
        }

                   
    }

?>