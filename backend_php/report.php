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

        $reportedID = $_POST['reportedID'];
        if(is_numeric($reportedID) && $reportedID > 0 && $reportedID == round($reportedID, 0)){
            //CHECK USER'S REPORT HISTORY AND LATEST REPORT TIME FOR SPAM
            $isSpam = false;
            $sql = "SELECT LatestReportTime, Reports FROM accounts WHERE Email = '$email'";
            $result = $mysqli->query($sql) or die("ouch, error");
            $nowTime = new DateTime();
            $resultAssoc = $result->fetch_assoc();
            $latestReportTime = $resultAssoc['LatestReportTime'];

            if(isset($latestReportTime)){
                $latestReportTimeDT = new DateTime($latestReportTime);
                $diff = $nowTime->getTimestamp() - $latestReportTimeDT->getTimestamp();
                if((int)$diff < 30){
                    $isSpam = true;
                }
            }


            $isDupe = false;
            $reportsStr = $resultAssoc['Reports'];
            if(isset($reportsStr) && strpos($reportsStr, $reportedID.',') !== false){
                $isDupe = true;
            }


            //FREE FROM SPAM
            if(!$isSpam && !$isDupe){
                //MARK THE QUOTE AS REPORTED
                $sql = "UPDATE happy_table SET isReported = 1 WHERE HappyID = $reportedID";
                $result = $mysqli->query($sql) or die("ouch, error");

                //UPDATE REPORT HISTORY AND LATEST REPORT TIME TO PREVENT SPAM
                $newReportsStr = $reportsStr.$reportedID.',';
                $sql = "UPDATE accounts SET LatestReportTime = NOW(), Reports = '$newReportsStr' WHERE Email = '$email'";
                $result = $mysqli->query($sql) or die("ouch, error");

                echo "SUCCESS";
            } else if ($isSpam) {
                echo $diff;
            } else {
                echo "DUPE";
            }
        }
    }
?>
