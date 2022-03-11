<?php

    require("config/connectionConfig.php");

	$conn = new mysqli($servername, $username, $password, "pilly");

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	error_log("Connected successfully",0);
?>