<?php
	$servername = "23.251.154.38";
	$username = "root";
	$password = "Aq2aJmx38mCw5PwI";
	$database_in_use = "encourageme";

	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $database_in_use);

	// Check connection
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}


?>