<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "passenger_detail";

	if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
		die("Falied to connect to database!");
	}