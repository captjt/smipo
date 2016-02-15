<?php
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['status']);
	unset($_SESSION['user_id']);
	session_unset();
	session_destroy();

	header("Location: login.php");
	exit;
?>