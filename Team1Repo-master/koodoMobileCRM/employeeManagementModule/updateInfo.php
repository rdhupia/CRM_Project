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
		
		$phoneNumber=htmlentities(trim($_POST['phoneNumber']));
		$emailAddress=htmlentities(trim($_POST['emailAddress']));
		$streetAddress=htmlentities(trim($_POST['streetAddress']));
		$city=htmlentities(trim($_POST['city']));
		$province=htmlentities(trim($_POST['province']));
		$postalCode=htmlentities(trim($_POST['postalCode']));
		$_SESSION['current_user']->Update($streetAddress,$city,$province,$postalCode,$phoneNumber,$emailAddress);
		header("location:myinfo.php");
	}
	
	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("Update Information");
	
	$addressId=$_SESSION['current_user']->getAddressId();
	
	$address= new Address();
	$address->loadById($addressId);
	$street=$address->getStreet();
	$city=$address->getCity();
	$province=$address->getProvince();
	$postalCode=$address->getPostalCode();
	
	?>

		<!-- MAIN CONTENT -->
		<div class="main-content container">
		<h3>Update Information</h3><br>
		
		<form class="form-horizontal" method="post">
			<div class="row">
				<div class="col-md-10">
					
					<div class="form-group">
						<label class="control-label  col-md-4">Phone Number</label>
						<div class="col-md-8">
							<input class="form-control" name="phoneNumber" placeholder="xxx xxx-xxxx" value="<?php echo $_SESSION['current_user']->getPhoneNumber(); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label  col-md-4">Email Address</label>
						<div class="col-md-8">
							<input class="form-control" name="emailAddress" placeholder="Email Address" value="<?php echo $_SESSION['current_user']->getEmailAddress(); ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label  col-md-4">Street Address</label>
						<div class="col-md-8">
							<input class="form-control" name="streetAddress" placeholder="Street Address" value="<?php echo $street; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label  col-md-4">City</label>
						<div class="col-md-8">
							<input class="form-control" name="city" placeholder="city" value="<?php echo $city; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label  col-md-4">Province</label>
						<div class="col-md-8">
							<input class="form-control" name="province" placeholder="Province" value="<?php echo $province; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label  col-md-4">Postal Code</label>
						<div class="col-md-8">
							<input class="form-control" name="postalCode" placeholder="Postal Code" value="<?php echo $postalCode; ?>">
						</div>
					</div>
					
					</div>
					</div>
					
				<div class="form-group">
				<label class="col-md-2"></label>
				<div class="col-md-2">
					<input class="btn btn-success col-md-12" type="submit" value="Submit">
					<!--<a href="viewMembership.php" class="btn btn-success col-md-12">Submit</a>-->
				</div>
			</div>
		</form>
		</div>

<?php
	$footer->writeFooter();
?>