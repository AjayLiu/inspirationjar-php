<?php

    include "setup_connection.php";
    include "redirectLinks.php";

    session_start();

    $email = $_SESSION['payload']['email'];


    //NOT LOGGED IN
    if(!isset($_SESSION['payload'])){
        $_SESSION['redir'] = "$indexLink";
        echo $loginPageLink;
    } else {
        $deleteID = $_POST['deleteID'];
        if(is_numeric($btnId) && $btnId > 0 && $btnId == round($btnId, 0)){
            //DELETE THE POST FROM happy_table
            $sql = "DELETE FROM happy_table WHERE HappyID = ?";
            $stmt = mysqli_stmt_init($mysqli);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL ERROR";
            } else {
                mysqli_stmt_bind_param($stmt, "i", $deleteID);
                mysqli_stmt_execute($stmt);
            }

            //DELETE FROM ACCOUNT's POST HISTORY
            $sql = "SELECT Posts FROM accounts WHERE Email = '$email'";
            $result = $mysqli->query($sql) or die("ouch, error");
            $postHist = $result->fetch_assoc()['Posts'];
            if(strpos($postHist, $deleteID.',') !== false){
                $postHist = str_replace($deleteID.',', '', $postHist);

                $sql = "UPDATE accounts SET Posts = '$postHist' WHERE Email = '$email'";
                $result = $mysqli->query($sql) or die("ouch, error");
                echo "SUCCESS";
            } else {
                echo "CANT DELETE, NOT FOUND IN YOUR POST HISTORY";
            }
        }


    }
?>
