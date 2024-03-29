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
        <title> My Account | Inspiration Jar </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="/css/styles.css" type="text/css">
		<link rel="stylesheet" href="/css/tabStyles.css" type="text/css">
		<link rel="icon" type="image/png" href="/images/logo.png">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<script src = "/js/randomColors.js"></script>


        <script src = "/js/accountPage.js"></script>
		<script src = "/js/countNumber.js"></script>
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
            <h1>my account</h1>
            <p>Manage your account here!</p>
		</div>

		<div class = "loginStatus">
			<?php
				if(isset($_SESSION['payload']['email'])){
					echo "You are logged in as: ".$_SESSION['payload']['email'];
				} else {
					$_SESSION["redir"] = $accountLink;
					header("LOCATION: ".$loginPageLink);
				}
			?>
			<br>
			<input type="image" src="/images/logout512.png" class = "logoutButton" value=''/>
		</div>

		<div id = "posts_root" >
			<!-- Tab links -->
			<div class="tab">
				<button class="tablinks tabPost" onclick="openPosts(event, 'Posts')" id="defaultOpen">Your Posts</button>
				<button class="tablinks tabFave" onclick="openPosts(event, 'Favorites')">Your Favorites</button>
				<button class="tablinks tabLike" onclick="openPosts(event, 'Likes')">Your Likes</button>
				<button class="tablinks tabDislike" onclick="openPosts(event, 'Dislikes')">Your Dislikes</button>
			</div>
			<!-- Tab content -->
			<div id="Posts" class="tabcontent">
				<div class = "yourGratitudeRating">
					<img src = "/images/wreath0.png">
					<div class = "likeCounter">
						Your Gratitude Rating:
						<div class = "count"></div>
					</div>
					<img src = "/images/wreath1.png">
				</div>
				<?php
					include "backend_php/load_posts.php";
				?>
			</div>


			<div id="Favorites" class="tabcontent">
				<?php
					include "backend_php/load_favorites.php";
   			 	?>
			</div>

			<div id="Likes" class="tabcontent">
				<?php
					include "backend_php/load_likes.php";
   			 	?>
			</div>

			<div id="Dislikes" class="tabcontent">
				<?php
					include "backend_php/load_dislikes.php";
   			 	?>
			</div>
		</div>


		<script src = "/js/loadTabs.js"></script>
		<script>
			// Get the element with id="defaultOpen" and click on it
			document.getElementById("defaultOpen").click();
		</script>
	</body>

</html>
