<?php
	include "backend_php/setup_connection.php";
	include "backend_php/redirectLinks.php";
	include "backend_php/rememberMe.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Home | EncourageMe </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="/css/styles.css" type="text/css">
		<link rel="stylesheet" href="/css/tabStyles.css" type="text/css">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	</head>

	<body>
		<div class = "navbar">
            <div class = "navanchors">
                <ul>
                    <li><a href = "index.php">Home</a></li>
					<li><a href = "myaccount.php">My Account</a></li>
                    <li><a href = "submit.php">Submit</a></li>
                    <li><a href = "contact.html">Contact</a></li>
                </ul>
            </div>
        </div>

		<div class = "intro">
            <h1>had a bad day?</h1>
            <p>Read some encouraging messages submitted from wholesome humans around the world!</p>
		</div>

		<input type="image" src="/images/gear.png" class = "settingsButton" value=''/>
		<!-- Tab links -->
		<div class = 'settingsTab'>
			<div class="tab">
				<h4>Sort by: &nbsp&nbsp</h4>
				<button class="tablinks" onclick="setSort(event, 'MostLiked')" id = "defaultOpen">Most Liked</button>
				<button class="tablinks" onclick="setSort(event, 'MostRecent')">Most Recent</button>
				<button class="tablinks" onclick="setSort(event, 'LeastLiked')">Least Liked</button>
				<button class="tablinks" onclick="setSort(event, 'LeastRecent')">Least Recent</button>
			</div>
		</div>

		<div id = "quotes_root" >
			<?php include "backend_php/load_quotes.php"; ?>
		</div>


        <script src = "/js/randomColors.js"></script>
		<script src = "/js/mainPageTabs.js"></script>

	</body>

</html>
