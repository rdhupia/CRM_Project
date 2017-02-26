<?php

	session_start();
	if (isset($_SESSION['current_user'])){	
		unset($_SESSION['current_user']);
		session_destroy();
		setcookie("PHPSESSID", "", time() - 61200,"/");	
	}
	header("Location: login.php");
	exit();
?>
			