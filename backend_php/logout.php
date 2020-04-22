<?php
    include "redirectLinks.php";
    include "setup_connection.php";
    session_start();

    //UNSET THE PAYLOAD
    $_SESSION['payload'] = null;

    //DELETE SESSION COOKIE FROM DATABASE
    $myCookie = $_COOKIE['session'];
    $sql = "DELETE FROM sessions WHERE session_id = ?";
    $stmt = mysqli_stmt_init($mysqli);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL ERROR";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $myCookie);
        mysqli_stmt_execute($stmt);
    }

    //DELETE THE COOKIE
    setcookie("session", "", time() - 3600);
    setcookie("session", "", time() - 3600, "/", $siteName);

    echo "SUCCESS";

?>
