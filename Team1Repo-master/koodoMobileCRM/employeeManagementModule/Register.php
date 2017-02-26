<?php
	//This is Page Template
	session_start();
	include("../library/library.php");
	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	//$menu->writeMenu("Register");
	/*
	private $id;
	private $addressId;
	private $firstName;//
	private $lastName;//
	private $userName;//
	private $passwordHash;//
	private $emailAddress;//
	private $adminLevel;//
	private $isActive;*/
	
	
	
	if($_POST)
	{
		if($_POST['password']!=$_POST['confirmPassword'])
		{
			$err="password and confirm password do not match";
		}
		//more conditions...
		else
		{
			
				$user= new User();
				$address= new Address();
				$addressId=$address->checkAddress($_POST['streetAddress'],$_POST['city'],$_POST['province'],$_POST['postalCode']);
				$user->addNew($_POST['firstName'],$_POST['lastName'],$_POST['userName'],crypt($_POST['password']),$_POST['phoneNumber'],$_POST['emailAddress'],$addressId,0,0);
				
				header("location: login.php");
			
			
		}
	}
?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
			<h2>Registration</h2><br>
			</div>
		</header>
		<!-- MAIN CONTENT -->
		<div class="main-content container-fluid">
			<form class="form-horizontal" method="post">
			<h3>Employee Information</h3>
				<div class="form-group">
					<label class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-4">
						<input class="form-control" name="firstName" placeholder="First Name" value="<?php if ($_POST) echo $_POST['firstName']; ?>">
					</div>
						
					<label class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-4">
						<input class="form-control" name="lastName" placeholder="Last Name" value="<?php if ($_POST) echo $_POST['lastName']; ?>">
					</div>
					<label class="col-sm-2 control-label">Phone Number</label>
					<div class="col-sm-4">
						<input class="form-control" name="phoneNumber" placeholder="xxx xxx-xxxx" value="<?php if ($_POST) echo $_POST['phoneNumber']; ?>">
					</div>
					<label class="col-sm-2 control-label">Email Address</label>
					<div class="col-sm-4">
						<input class="form-control" name="emailAddress" placeholder="Email Address" value="<?php if ($_POST) echo $_POST['emailAddress']; ?>">
					</div>
					
					<label class="col-sm-2 control-label">Street Address</label>
					<div class="col-sm-4">
						<input class="form-control" name="streetAddress" placeholder="Street Address" value="<?php if ($_POST) echo $_POST['streetAddress']; ?>">
					</div>
					<label class="col-sm-2 control-label">City</label>
					<div class="col-sm-4">
						<input class="form-control" name="city" placeholder="City" value="<?php if ($_POST) echo $_POST['city']; ?>">
					</div>
					<label class="col-sm-2 control-label">Province</label>
					<div class="col-sm-4">
						<input class="form-control" name="province" placeholder="Province" value="<?php if ($_POST) echo $_POST['province']; ?>">
					</div>
					<label class="col-sm-2 control-label">Postal Code</label>
					<div class="col-sm-4">
						<input class="form-control" name="postalCode" placeholder="Postal Code" value="<?php if ($_POST) echo $_POST['postalCode']; ?>">
					</div>
				</div>
					<hr>
					<div class="col-md-6">
					
					
					<h3>Login Details</h3><br>
					<div class="form-group">
						<label class="control-label  col-md-4">User Name</label>
						<div class="col-md-8">
							<input class="form-control" name="userName"  >
						</div>
					
						<label class="control-label  col-md-4">Password</label>
						<div class="col-md-8">
							<input class="form-control" name="password"  type="password">
						</div>
						<label class="control-label  col-md-4">Confirm Password</label>
						<div class="col-md-8">
							<input class="form-control" name="confirmPassword" type="password">
						</div>
						<div class="col-md-4">
						<!--<input class="form-control" type="submit" value="Submit">-->
						
						<a href="login.php" class="btn btn-primary ">Go Back</a>
						<input class="btn btn-success form-control" type="submit" value="submit"/>
						</div>
				</div>
			</div>	
			
		</form>
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>