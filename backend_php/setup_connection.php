<?php

	//OLD SQL
	// $servername = "23.251.154.38";
	// $username = "root";
	// $password = "Aq2aJmx38mCw5PwI";
	// $database_in_use = "encourageme";

	//NEW SQL
	$servername = "34.105.109.227";
	$username = "root";
	$password = "OI8z1HuxFEuj50N3";
	$database_in_use = "inspirationjar";

	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $database_in_use);

	// Check connection
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>
