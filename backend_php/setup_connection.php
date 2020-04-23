<?php
	// $servername = "23.251.154.38";
	// $username = "root";
	// $password = "Aq2aJmx38mCw5PwI";
	// $database_in_use = "encourageme";
	$servername = "35.199.147.183";
	$username = "root";
	$password = "dfgMitqsdzx5zzfI";
	$database_in_use = "inspirationjar";

	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $database_in_use);

	// Check connection
	if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	}
?>
