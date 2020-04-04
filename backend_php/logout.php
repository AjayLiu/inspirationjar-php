<?php
    include "setup_connection.php";
    session_start();

    //UNSET THE PAYLOAD
    $_SESSION['payload'] = null;

    //DELETE SESSION COOKIE FROM DATABASE
    $myCookie = $_COOKIE['session'];
    $sql = "DELETE FROM sessions WHERE session_id = '$myCookie'";
    $result = $mysqli->query($sql) or die("ouch, error");

    //DELETE THE COOKIE
    setcookie('session', '' , time() - 3600);

    echo "SUCCESS";
?>
