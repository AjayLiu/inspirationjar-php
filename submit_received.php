<?php
    include "backend_php/setup_connection.php";
    include "backend_php/redirectLinks.php";
    include "backend_php/rememberMe.php";

    session_start();

    $email = $_SESSION['payload']['email'];

    $isEmpty = false;
    $tooLong = false;

    if(isset($email)){
        if(isset($_GET["inputQuote"]) && $_GET["inputQuote"] != ''){
            ///GET HISTORY FROM THIS ACCOUNT
            $sql = "SELECT Posts, isBanned FROM accounts WHERE Email = '$email';";
            $result = $mysqli->query($sql) or die("ouch, error");
            $accountInfo = $result->fetch_assoc();
            $prevPosts = $accountInfo['Posts'];
            $prevPostsIDs = explode(",","$prevPosts");

            if(strlen($_GET["inputQuote"]) > 400){
                $tooLong = true;
            }

            $quote = mysqli_real_escape_string($mysqli, $_GET["inputQuote"]);

            //CHECK IF USER IS BANNED
            $isBanned = false;
            if($accountInfo['isBanned']){
                $isBanned = true;
            }

            //CHECK IF CONTAINS PROFANITY
            $isSwear = false;
            $profanityArr = include("backend_php/profanities.php");

            foreach(explode(' ', $quote) as $str){
                $cleanerStr = strtolower(str_replace(array("?","!",",",";","."," "), "", $str));
                if(in_array($cleanerStr, $profanityArr)){
                    $isSwear = true;
                    break;
                }
            }




            /*
            $check = new Check();
            */
            //SEARCH THROUGH HISTORY FOR DUPLICATES OR SPAM (submitted too fast from the previous)

            $isDupe = false;
            $isSpam = false;

            //CHECK FOR SPAM
            if(count($prevPostsIDs) > 1){
                $latestPostID = $prevPostsIDs[count($prevPostsIDs)-2]; //most recent post
                $sql = "SELECT HappyDate FROM happy_table WHERE HappyID = '$latestPostID'";
                $result = $mysqli->query($sql) or die("ouch, error");
                if(isset($result)){
                    $nowTime = new DateTime();

                    $latestPostTime = $result->fetch_assoc()['HappyDate'];
                    $latestPostTimeDT = new DateTime($latestPostTime);

                    // $interval = $nowTime->diff($latestPostTimeDT);
                    // $secsElapsed = $interval->format('%s');
                    $diff = $nowTime->getTimestamp() - $latestPostTimeDT->getTimestamp();

                    if((int)$diff < 30){
                        $isSpam = true;
                    }
                }

            }

            //CHECK FOR DUPLICATES
            $sql = "SELECT HappyID FROM happy_table WHERE Happy_quote = '$quote'";
            $result = $mysqli->query($sql) or die("ouch, error");
            //echo $result->fetch_assoc()['HappyID'];
            if($result->fetch_assoc()['HappyID'] != null){
                //FOUND A DUPLICATE IN HISTORY
                $isDupe = true;
            }


            if(!$isDupe && !$isSpam && !$isSwear && !$isBanned && !$tooLong){
                //ADD NEW UNIQUE QUOTE
                $sql = "INSERT INTO happy_table (HappyID, Happy_quote, HappyRating, HappyDate) VALUES (NULL, ?, 0, NOW())";
                $stmt = mysqli_stmt_init($mysqli);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL ERROR";
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $quote);
                    mysqli_stmt_execute($stmt);
                }


                //ADD TO ACCOUNT's POST HISTORY
                $sql = "SELECT HappyID FROM happy_table WHERE Happy_quote = ? ORDER BY HappyDate DESC LIMIT 1";
                $stmt = mysqli_stmt_init($mysqli);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL ERROR";
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $quote);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $thisId);
                    while(mysqli_stmt_fetch($stmt)){
                        $newId = $thisId;
                    }
                    $sql = "UPDATE accounts SET Posts = CONCAT('$prevPosts', '$newId,') WHERE Email = '$email'";
                    $result = $mysqli->query($sql) or die("ouch, error");
                }
            }

        } else {
            $isEmpty = true;
        }
    } else {
        $_SESSION['redir'] = "$submitLink";
        header("Location: $loginPageLink");
    }
?>

<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Submission Received | Inspiration Jar </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="/css/styles.css" type="text/css">
        <link rel="icon" type="image/png" href="/images/logo.png">
        <link rel="stylesheet" href="/css/submit.css" type="text/css">

    </head>

    <body>

        <div class = "navbar">
            <div class = "navanchors">
                <ul>
                    <li><a href = "index.php">Home</a></li>
					<li><a href = "myaccount.php">My Account</a></li>
					<li id = "logo"><a href = "index.php"><img src = "/images/logo.png"></a></li>
                    <li class="skewLeft"><a href = "submit.php">Submit</a></li>
					<li class="skewLeft"><a href = "about.html">About</a></li>
                </ul>
            </div>
        </div>
        <div class = "panel">
            <div class = "submitSuccess">
                <?php
                    if($isBanned){
                        echo "Sorry, it looks like your account has been suspended from posting quotes. If you would like to repeal this decision, visit the contacts page.";
                    }else if($isSwear) {
                        echo "We've detected some profanity in your quote. Please keep your quotes friendly and don't spread hate.";
                    } else if($isDupe){
                        echo "It looks like this quote was submitted before. Maybe try thinking of another quote!";
                    } else if($isEmpty) {
                        echo "Please type in something before submitting!";
                    } else if($isSpam){
                        echo "It looks like you submitted a quote $diff seconds ago. Please wait for at least 30 seconds before submitting again as we want to prevent spammers.";
                    } else if($tooLong) {
                        echo "Your quote is too long! Please keep your quote shorter than 400 characters!";
                    }else {
                        echo "Thanks for your submission! Your quote will be on the front page after review!";
                    }
                ?>
            </div>

            <div class = "submitAnother">
                <a href = "submit.php">Submit Another Quote</a>
            </div>
        </div>
    </body>
</html>
