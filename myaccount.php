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
        <script>
            $(document).ready(
                function(){
                    //PROMPT LOGIN PAGE IF NOT LOGGED IN
                    $.ajax({
                      type: 'GET',
                      url: 'backend_php/isLoggedIn.php',
                      cache: false,
                      success: function(result) {
                          if(result != "LOGGED IN"){
                              //REDIRECT TO LOGIN
                              window.location = response;
                          }
                      }
                    });
                }
            );

			function logout(){
				alert("LOGOUT");
				//LOG OUT
				$.ajax({
				  type: 'GET',
				  url: 'backend_php/logout.php',
				  cache: false,
				  success: function(result) {
					  alert(result);
				  }
				});
			}
        </script>
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
			if($_SESSION['payload']['email'] != null){
				echo "You are logged in as: ".$_SESSION['payload']['email'];
			} else {
				$_SESSION["redir"] = $accountLink;
				header("LOCATION: ".$loginPageLink);
			}
		?>

		<button class = "logoutButton" onclick="logout()">Log out</button>

	</body>

</html>
