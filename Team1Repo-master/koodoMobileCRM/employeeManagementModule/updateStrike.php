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
		$strikeID=$_GET['id'];
	}
	
	if($_POST){
		$strike=new Strike();
		$strike->loadById($_POST['strikeId']);
		$userId=$strike->getUserId();
		$reason=htmlentities(trim($_POST['reason']));
		$strike->update($_POST['status'],$reason);
		header("location: ViewStrikes.php?id=".$userId);
	}
	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("UpdateStrike");
	
	$strike=new Strike();
	$strike->loadById($strikeID);
	$timestamp=$strike->getTimestamp();
	$comment=$strike->getComment();
	$status=$strike->getStatus();
	
	
	?>

		<!-- MAIN CONTENT -->
		<div class="main-content container-fluid">
		<h4>Striking:<?php echo $_SESSION['current_user']->getFullName($strike->getUserId())?></h4><hr>
		<form method=post class=form-horizontal>
		<div class="form-group">
		<label for="status" class="control-label col-sm-2 control-label">Status</label>
			<div class="col-sm-2">
				<select class="form-control" name="status" id="strikeStatus">
					<option value="active">Active</option>
					<option value="cancelled">Cancelled</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			
			<label for="reason" class="control-label col-sm-2 control-label">Reason</label>  
			<div class="col-sm-8">
				<textarea class=form-control name="reason" rows=4 placehold="Reasons" value="<?php echo $comment?>" ><?php echo $comment?></textarea>
			</div>
		</div>
		
		<hr>
		<input hidden name=strikeId value=<?php echo $strikeID ?> />
		<div>
			<input type="submit" value="Submit" class="btn btn-success btn-lg" />
		</div>
	
		</form>
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>