<?php
	//This is Page Template
	include("../library/library.php");
	
	session_start();
	if (!isset($_SESSION['current_user'])){
      header("location:login.php");
      exit();
	}
	
	if($_POST){
		$userID=$_POST['id'];
		$user= new User();
		$user->loadById($userID);
		$address=new Address();
		
		
		if(!isset($_POST['phoneNumber']))
		$err="Phone Number must be filled";
		else if(!isset($_POST['emailAddress']))
		$err="Email Address must be filled";
		else if(!isset($_POST['streetAddress']))
		$err="Street Address must be filled";
		else if(!isset($_POST['city']))
		$err="City must be filled";
		else if(!isset($_POST['province']))
		$err="Province must be filled";
		else if(!isset($_POST['postalCode']))
		$err="Postal Code must be filled";
		
		if(!isset($err))
		{
			$user->Update($_POST['streetAddress'],$_POST['city'],$_POST['province'],$_POST['postalCode'],$_POST['phoneNumber'],$_POST['emailAddress']);
			header("location:UserManager.php");
		}
		
	}
	
	if($_GET){
		$userID=$_GET['id'];
		$user= new User();
		$user->loadById($userID);
		
		$address=new Address();
		$address->loadById($user->getAddressId());
		
		$phoneNumber=$user->getPhoneNumber();
		$email=$user->getEmailAddress();
		
		$street=$address->getStreet();
		$city=$address->getCity();
		$province=$address->getProvince();
		$postalCode=$address->getPostalCode();
		
	}
	else if(!isset($user))
	{
		header("location:UserManager.php");
	}
	
	
	
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("Register");
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
			<h2>Edit: <?php echo $user->getFirstName()." ".$user->getLastName();?></h2><br>
			</div>
		</header>
		<!-- MAIN CONTENT -->
		<div class="main-content container-fluid">
			<form class="form-horizontal" method="post">
			<h3>Employee Information</h3>
				<div class="form-group">
					<label class="col-sm-2 control-label">Phone Number</label>
					<div class="col-sm-4">
						<input class="form-control" name="phoneNumber" placeholder="xxx xxx-xxxx" value="<?php if ($_POST){ echo $_POST['phoneNumber']; }else{ echo $phoneNumber;}?>">
					</div>
					<label class="col-sm-2 control-label">Email Address</label>
					<div class="col-sm-4">
						<input class="form-control" name="emailAddress" placeholder="Email Address" value="<?php if ($_POST){ echo $_POST['emailAddress']; }else{ echo $email;}?>">
					</div>
					<label class="col-sm-2 control-label">Street Address</label>
					<div class="col-sm-4">
						<input class="form-control" name="streetAddress" placeholder="Street Address" value="<?php if ($_POST){ echo $_POST['streetAddress']; }else{ echo $street;}?>">
					</div>
					<label class="col-sm-2 control-label">City</label>
					<div class="col-sm-4">
						<input class="form-control" name="city" placeholder="City" value="<?php if ($_POST){ echo $_POST['city']; }else{echo $city;}?>">
					</div>
					<label class="col-sm-2 control-label">Province</label>
					<div class="col-sm-4">
						<input class="form-control" name="province" placeholder="Province" value="<?php if ($_POST){ echo $_POST['province']; }else{echo $province;}?>">
					</div>
					<label class="col-sm-2 control-label">Postal Code</label>
					<div class="col-sm-4">
						<input class="form-control" name="postalCode" placeholder="Postal Code" value="<?php if ($_POST){ echo $_POST['postalCode']; }else{echo $postalCode;} ?>">
					</div>
					<input hidden name=id value=<?php echo $userID ?> />
				</div>
				<hr>
				<div class="col-md-8">
					<div class="form-group">
						
						<div class="span1">
						
						<a href="UserManager.php" Style="Margin-right:5px" class="btn btn-primary btn-lg">Back</a>
						<a href="EditUser.php?id=<?php echo $userID;?>" Style="Margin-right:5px" class="btn btn-default btn-lg">Default</a>
						<a href="ResetPassword.php?id=<?php echo $userID;?>" Style="Margin-right:5px" class="btn btn-warning btn-lg">Reset Password</a>
						<input class="btn btn-success btn-lg" type="submit" value="Submit">
						
						</div>
					</div>
				</div>	
			
		</form>
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>