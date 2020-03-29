<?php
    include "setup_connection.php";
    session_start();

    $email = $_SESSION['payload']['email'];

    $isEmpty = false;

    if(isset($email)){
        if(isset($_GET["inputQuote"]) && $_GET["inputQuote"] != ''){
            //GET POST HISTORY FROM THIS ACCOUNT
            $sql = "SELECT Posts FROM accounts WHERE Email = '$email';";
            $result = $mysqli->query($sql) or die("ouch, error");                                 
            $prevPosts = $result->fetch_assoc()['Posts'];
            $prevPostsIDs = explode(",","$prevPosts");
            
            $quote = mysqli_real_escape_string($mysqli, $_GET["inputQuote"]);

            //SEARCH THROUGH HISTORY FOR DUPLICATES
            $isDupe = false;
            for($i = 0; $i < count($prevPostsIDs)-1; $i++) {
                $id = $prevPostsIDs[$i];
                $sql = "SELECT Happy_quote FROM happy_table WHERE HappyID = $id";
                $result = $mysqli->query($sql) or die("ouch, error");

                if($result->fetch_assoc()['Happy_quote'] == $quote){
                    //FOUND A DUPLICATE IN HISTORY
                    $isDupe = true;
                    break;
                }
            }

            
            if(!$isDupe){
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
                $sql = "SELECT HappyID FROM happy_table WHERE Happy_quote = ?";            
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
        $_SESSION['redir'] = "http://localhost/submit.php";
        header("Location: http://localhost/login_page.php");
    }
?>

<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Submission Received | EncourageMe </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="styles.css" type="text/css">
    </head>

    <body>
        
        <div class = "navbar">
            <div class = "navanchors">
                <ul>
                    <li><a href = "index.php">Home</a></li>
                    <li><a href = "submit.php">Submit</a></li>
                    <li><a href = "contact.html">Contact</a></li>
                </ul>
            </div>            
        </div>
        <div class = "submitSuccess">
            <?php 
                if($isDupe){
                    echo "It looks like you submitted this before. Maybe try thinking of another quote!";         
                } else if($isEmpty) {
                    echo "Please type in something before submitting!";
                } else {
                    echo "Thanks for your submission!";
                }

                
            ?>
        </div>

        <div class = "submitAnother">
            <a href = "submit.php">Submit Another Quote</a>
        </div>
    </body>
</html>



