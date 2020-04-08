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
        <title> My Account | EncourageMe </title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="/css/styles.css" type="text/css">

        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src = "/js/accountPage.js"></script>
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
            <h1>my account</h1>
            <p>Manage your account here!</p>
		</div>


		<?php
			if(isset($_SESSION['payload']['email'])){
				echo "You are logged in as: ".$_SESSION['payload']['email'];
			} else {
				$_SESSION["redir"] = $accountLink;
				header("LOCATION: ".$loginPageLink);
			}
		?>
		<button class = "logoutButton" onclick="logout()">Log out</button>

		<hr width = 50%>

		<div id = "posts_root" >
			<?php
				include "backend_php/load_posts.php";
				include "backend_php/load_favorites.php";
				include "backend_php/load_likes.php";
				include "backend_php/load_dislikes.php";
			?>
		</div>


	</body>

</html>
