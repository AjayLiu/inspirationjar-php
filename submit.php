<?php
    include "setup_connection.php";
?>

<html>

	<head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Submit | EncourageMe </title>
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
		<div class = "intro">
            <h1>wanna brighten up someone's day?</h1>
            <p>" Research shows that complimenting someone can be even more uplifting than receiving one! " - <i> Some Guy, 2020 </i> </p>                             
        </div> 

		<form action="submit_received.php" method="get">
			Your Quote: <input type="text" name="inputQuote"><br>
			<input type="submit" value = "Submit">
		</form>
		
	</body>

</html>

<?php include "google.php" ?>