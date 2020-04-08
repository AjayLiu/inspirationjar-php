<?php
    include "setup_connection.php";

    session_start();


    if(isset($_COOKIE['session'])){
        $sql = "SELECT email FROM sessions WHERE session_id = ?";
        $stmt = mysqli_stmt_init($mysqli);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL ERROR";
        } else {
            $cookie = $_COOKIE['session'];
            mysqli_stmt_bind_param($stmt, "s", $cookie);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $savedEmail = $row['email'];

            if(isset($savedEmail)){
                $_SESSION['payload']['email'] = $savedEmail;
            }
        }


    } else {
        //echo "NO COOKIE FOUND YO";
    }

?>
