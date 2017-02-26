<?php
	//This is Page Template
	include("../library/library.php");
	session_start();
	//check if user is logged in 
	if (!isset($_SESSION['current_user'])){
      header("location:login.php");
      exit();
	}
	
	
	
	if($_POST){
		$currentPassword=htmlentities(trim($_POST['currentPassword']));
		$newPassword=htmlentities(trim($_POST['newPassword']));
		$confirmPassword=htmlentities(trim($_POST['confirmPassword']));
		if($_SESSION['current_user']->checkPassword($currentPassword)){
			if($newPassword==$confirmPassword){
				$_SESSION['current_user']->updatePassword($newPassword);	
				header('location:home.php');
			}
		}
		else{
			$err="The current password is incorrect";
		}
	}
	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("Update_Password");
		
		
	
	
	?>

		<!-- MAIN CONTENT -->
		<div class="main-content container">
			<h3>Change Password</h3><br>
			<form class="form-horizontal" method="post">
			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
					<label class="control-label  col-md-4" style="min-width:180px;">Current password</label>
						<div class="col-md-8">
							<input class="form-control" name="currentPassword" type="password" >
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label  col-md-4"style="min-width:180px;">New password</label>
							<div class="col-md-8">
								<input class="form-control" name="newPassword" type="password" >
							</div>
					</div>	
					<div class="form-group">
						<label class="control-label  col-md-4"style="min-width:180px;">Confirm password</label>
						<div class="col-md-8">
							<input class="form-control" name="confirmPassword" type="password" >
						</div>
					</div>
					
				</div>
				
			</div>	
			<div class="form-group">
				<label class="col-md-2"></label>
				<div class="col-md-2">
					<input class="btn btn-success col-md-12" type="submit" value="Submit">
				</div>
			</div>
		</form>
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>