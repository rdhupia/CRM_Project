<?php
	include("../library/library.php");
	
	session_start();
	$menu = new Menu();

	$err="";
	$header = new Header();
	$footer = new Footer();
	$dblink = new DBLink();
	
	if($_GET)
	{
		//connect to DB
		$user= new User();
		$user->loadById($_GET['id']);
		
		$user->toggleStatus();
			
    }
	header("location:UserManager.php");
	?>
