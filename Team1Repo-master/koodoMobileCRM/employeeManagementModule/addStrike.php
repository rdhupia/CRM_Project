<?php
	//This is Page Template
	include("../library/library.php");
	session_start();
	//check if user is logged in 
	if (!isset($_SESSION['current_user'])){
      header("location:login.php");
      exit();
	}
	
	
	if($_GET){
		$userID=$_GET['id'];
	}
	
	if($_POST){
		$reason=htmlentities(trim($_POST['reason']));
		
			
		$date = new DateTime();
		date_default_timezone_set('US/Eastern');
		$date=date_default_timezone_get();
		
		$strikeId=Strike::addNew($_POST['userId'],$_SESSION['current_user']->getId(),$reason,'active');
		header("location: ViewStrikes.php?id=".$_POST['userId']);
	}
	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("addStrike");
	
	
	?>

		<!-- MAIN CONTENT -->
		<div class="main-content container-fluid">
		<h4>Striking:<?php echo $_SESSION['current_user']->getFullName($userID)?></h4><hr>
		<form method=post class=form-horizontal>
		<div class="form-group">
			
			<label for="reason" class="control-label col-sm-2 control-label">Reason</label>  
			<div class="col-sm-10">
				<textarea class=form-control name="reason" rows=4 placehold=Reasons></textarea>
			</div>
		</div>
		<hr>
		<input hidden name=userId value=<?php echo $userID ?> />
		<div>
			<input type="submit" value="Submit" class="btn btn-success btn-lg" />
		</div>
	
		</form>
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>