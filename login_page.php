<?php
    include "setup_connection.php";
?>

<html>

	<head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Login | EncourageMe </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel="stylesheet" href="styles.css" type="text/css">
	</head>

	<body>
		<div class = "navbar">
            <div class = "navanchors">
                <ul>
                    <li><a href = "index.php">Home</a></li>
                    <li><a href = "login_page.php">Submit</a></li>
                    <li><a href = "contact.html">Contact</a></li>
                </ul>
            </div>            
        </div>
		<div class = "intro">
            <h1>Log in</h1>
            <p> Don't worry, all your activity will be kept anonymous. Logging in is just to ensure that all posts/likes/dislikes are unique.
        </div> 		
	</body>

</html>

<?php       
    include "google.php"; 
?>