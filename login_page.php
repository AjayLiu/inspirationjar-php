<?php
    include "backend_php/setup_connection.php";
?>

<html>

	<head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Login | Inspiration Jar </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel="stylesheet" href="/css/styles.css" type="text/css">
        <link rel="icon" type="image/png" href="/images/logo.png">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
		<div class = "intro">
            <h1>Log in</h1>
            <p> Don't worry, all your activity will be kept anonymous from other users. Logging in is just to ensure that all posts/likes/dislikes are unique and for you to save your favorites!
        </div>
        <div>
            <?php
                include "google.php";
            ?>
        <div>
        <div class = "rememberMe">
            <input type="checkbox" id="rememberCheckbox" class = "rememberChange" value="Remember" checked readonly>
            <label for="remember me" id = "rememberLabel" class = "rememberChange"> <a> &nbspRemember me </a> </label>
        </div>


	</body>

    <script src = "/js/loginPage.js"></script>



</html>
