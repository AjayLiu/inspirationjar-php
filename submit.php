<?php
    include "backend_php/setup_connection.php";
    include "backend_php/redirectLinks.php";
    include "backend_php/rememberMe.php";
    session_start();
?>

<html>

	<head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Submit | Inspiration Jar </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel="stylesheet" href="/css/styles.css" type="text/css">
        <link rel="stylesheet" href="/css/submit.css" type="text/css">
        <link rel="icon" type="image/png" href="/images/logo.png">
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
            <div class = "intro">
                <h1>wanna brighten up someone's day?</h1>
                <p>"Research shows that complimenting someone can be even more uplifting than receiving one!" - <i> Some Guy, 2020 </i> </p>
                <div class = "loginStatus">
        			<?php
        				if(isset($_SESSION['payload']['email'])){
        					echo "You are logged in as: ".$_SESSION['payload']['email'];
        				} else {
        					$_SESSION["redir"] = $accountLink;
        					header("LOCATION: ".$loginPageLink);
        				}
        			?>
        		</div>
            </div>

    		<form action="submit_received.php" method="get">
    			<br>
                <label for = "quote">Your Quote</label>
                <br><br>
                " <input autofocus class = "submitQuoteInputBox" type="text" name="inputQuote" maxlength="400"> " <input type="submit" value = "Submit">

    		</form>

            <em><br><br>Please keep your quotes appropriate and uplifting. If your quotes are reported and reviewed to be inappropriate, spam, malicious, or irrelevant to this site, your account's privilege to post may be revoked.</em>

        </div>

        
	</body>

</html>
