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
        <title>Home | Inspiration Jar </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="/css/styles.css" type="text/css">
		<link rel="stylesheet" href="/css/tabStyles.css" type="text/css">
		<link rel="stylesheet" href="/css/homepage.css" type="text/css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

		<div class = "splashScreen">
			<div id = "jar"> 
				<div id = "jarAndLabel">
					<div id = "clickMeIndicator">
						<label id = "clickLabel">Click the jar!</label>
					</div>
					<input type="image" src = "/images/jar.png" id = "jarImg" value=''/>
				</div>
				<div id = 'title'>
					<div id = "titleText">
						Inspiration Jar
					</div>
					<div id = 'titleDescription'>
						read some encouraging messages to help you through hard times!
					</div>
					<div id = 'jarQuote'>

					</div>
				</div>
			</div>
			<div id = "scrollIndicator">
				<input type="image" src = "/images/scroll.png" id = "scrollIndicatorInput" value=''/>
				<!-- <label id = "scrollLabel">Scroll down to browse all quotes!</label> -->
			</div>
		</div>
		<div id = "browseTitle">
			Browse all quotes!
		</div>

		<input alt = "search filter settings button" type="image" src="/images/gear.png" class = "settingsButton" value=''/>
		<!-- Tab links -->
		<div class = 'settingsTab'>
			<div id = "unique">
				<input type="checkbox" id="uniqueCheckbox" class = "uniqueChange" readonly>
	            <label for="unique quotes only" id = "uniqueLabel" class = "uniqueChange"> <a>&nbspOnly show quotes I haven't voted on </a> </label>
			</div>
			<div class="tab">
				<h4>Sort by: &nbsp&nbsp</h4>
				<button class="tablinks" onclick="setSort(event, 'MostLiked')" id = "defaultOpen">Most Liked</button>
				<button class="tablinks" onclick="setSort(event, 'LeastLiked')">Least Liked</button>
				<button class="tablinks" onclick="setSort(event, 'MostRecent')">Newest</button>
				<button class="tablinks" onclick="setSort(event, 'LeastRecent')">Oldest</button>
			</div>
			<div id = "search">
				<input type="text" id='searchBar' placeholder="Search..">
				<input type="image" src="/images/search.png" id = 'searchSubmit'>
			</div>
		</div>

		<script>var allowRefresh = true; var isSearch = false;</script>
		<div id = "quotes_root" >
			<?php //include "backend_php/load_quotes.php"; ?>
		</div>
		<div class = "loadingIndicator">
			Loading quotes...
		</div>

        <script src = "/js/randomColors.js"></script>
		<script src = "/js/splashScreenAnimation.js"></script>
		<script src = "/js/jarclick.js"></script>
		<script src = "/js/scrollAnim.js"></script>
		<script src = "/js/mainPageTabs.js"></script>

		<footer>
            © 2020 Ajay Liu. All Rights Reserved • <a href = "https://mail.google.com/mail/?view=cm&fs=1&to=contact@ajayliu.com">contact@ajayliu.com</a>
        </footer>
	</body>

</html>
