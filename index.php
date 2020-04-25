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
				<div>
					<input type="image" src = "/images/jar.png" id = "jarImg" value=''/>
					<div id = "clickMeIndicator">
						<label id = "clickLabel">Click the jar!</label>
						<!-- <input type="image" src = "/images/click.png" id = "clickMeIndicatorInput" value=''/> -->
					</div>
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
			<div class="tab">
				<h4>Sort by: &nbsp&nbsp</h4>
				<button class="tablinks" onclick="setSort(event, 'MostLiked')" id = "defaultOpen">Most Liked</button>
				<button class="tablinks" onclick="setSort(event, 'LeastLiked')">Least Liked</button>
				<button class="tablinks" onclick="setSort(event, 'MostRecent')">Latest</button>
				<button class="tablinks" onclick="setSort(event, 'LeastRecent')">Oldest</button>
			</div>
		</div>

		<div id = "quotes_root" >
			<?php //include "backend_php/load_quotes.php"; ?>
		</div>
		<div class = "loadingIndicator">
			Loading quotes...
		</div>

        <script src = "/js/randomColors.js"></script>
		<script src = "/js/mainPageTabs.js"></script>
		<script src = "/js/splashScreenAnimation.js"></script>
		<script src = "/js/jarclick.js"></script>
		<script src = "/js/scrollAnim.js"></script>

	</body>

</html>
