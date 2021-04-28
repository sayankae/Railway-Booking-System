<?php
session_start();
	
	if(isset($_SESSION['p_id'])){
		unset($_SESSION['user_id']);
		session_destroy();
		header("Location: homepage.html");
		die;
	}