<?php
    include "setup_connection.php";
    
    if(isset($_GET["inputQuote"])){
        $quote = mysqli_real_escape_string($mysqli, $_GET["inputQuote"]);
    
        $sql = "INSERT INTO happy_table (HappyID, Happy_quote, HappyRating) VALUES (NULL, ?, 0)";
        
        $stmt = mysqli_stmt_init($mysqli);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL ERROR";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $quote);
            mysqli_stmt_execute($stmt);
        }
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
            Thanks for your submission!
        </div>

        <div class = "submitAnother">
            <a href = "submit.php">Submit Another Quote</a>
        </div>
    </body>
</html>



