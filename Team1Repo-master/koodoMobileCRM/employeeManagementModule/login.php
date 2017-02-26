<?php
	include("../library/library.php");
	
	session_start();
	$menu = new Menu();

	$err="";
	$header = new Header();
	$footer = new Footer();
	$dblink = new DBLink();
	
	if($_POST)
	{
		//connect to DB
		$user= new User();
		$user->login($_POST["userName"],$_POST["password"],$_POST["store"]);
		if(is_null($user->signedIn())|| $user->signedIn()==0)
			$err="Combination of user name and password was not found";
		else
		{
			$_SESSION['current_user']=$user;
			header("location:home.php");
			exit();
		}
    }
	
	$header->writeHeader();
	?>

		<!-- MAIN CONTENT -->
		<div class="main-content container-fluid">
			<div class="row">
				<div class="col-md-offset-4 col-md-4">
					<img src="../img/wc_logo_large_transparent.png" class="img img-responsive">
				</div>
			</div>
			<br>
			<br>
			
			<form class="form-horizontal" method="post">
				<div class="form-group">
					<label class="control-label  col-md-4">Location</label>
					<div class="col-md-4">
						<select name="store" required class="form-control">
							<option value="">---Select Location---</option>
							<option value="S">1700 Wilson</option>
							<option value="W">1571 Sandhurst</option>
							<option value="T">1575 Jane</option>
							<option value="Y">7181 Yonge</option>
						</select>
					</div>
				</div>
					
			
			<form class="form-horizontal" method="post">
				<div class="form-group">
					<label class="control-label col-md-4">User Name</label>
					<div class="col-md-4">
						<input class="form-control" name="userName"  maxlength="5" placeholder="User Name" required>
					</div>
				</div>	
				
				<div class="form-group">
					<label class="control-label  col-md-4">Password</label>
					<div class="col-md-4">
						<input class="form-control" type="password" name="password"  maxlength="10" placeholder="Password" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label  col-md-4"></label>
					<div class="col-md-4">
						<input class="btn btn-primary form-control" type="submit" value="LOGIN">
					</div>
				</div>	
				<div class="form-group">
					<label class="control-label  col-md-4"></label>
					<div class="col-md-4 bg-danger">
						<?php
							echo $err;
						?>
					</div>
				</div>	
			</form>
			<div class="row text-center">
				<a href=Register.php >Register New Account</a>
				<br>
			
			</div>

			</div>
<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>