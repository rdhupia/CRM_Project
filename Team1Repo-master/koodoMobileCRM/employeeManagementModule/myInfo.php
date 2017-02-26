<?php
	//This is Page Template
	include("../library/library.php");
	session_start();
	
	if (!isset($_SESSION['current_user'])){
      header("location:login.php");
      exit();
	}
	
	$address= new Address();
	$address->loadById($_SESSION['current_user']->getAddressId());
	$street=$address->getStreet();
	$city=$address->getCity();
	$province=$address->getProvince();
	$postalCode=$address->getPostalCode();
	
	$menu = new Menu();
	$firstName=$_SESSION['current_user']->getFirstName();
	$lastName=$_SESSION['current_user']->getLastName();
	$POS=$_SESSION['current_user']->getUserName();
	$phoneNumber=$_SESSION['current_user']->getPhoneNumber();
	$emailAddress=$_SESSION['current_user']->getEmailAddress();
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("MyInfo");
	?>
<!-- HEADER -->
<header class="container">
	<div class="row">
		<h2>My Information</h2>
	</div>
</header>
<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container-fluid">
		
		<form method=post class=form-group>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<table class="table">
						<tr>
							<td>Name:</td>
							<td>
							<?php
								echo $firstName . " ". $lastName;
							?>
						</td>
						
						</tr>
						
						<tr>
						<td>
							User Name:
						</td>
						<td>
							<?php
								echo $POS;
							?>
						</td>
						</tr>
						<tr>
						<td>
							Phone number:
						</td>
						<td>
							<?php
								echo $phoneNumber;
							?>
						</td>
						<td>
							<a  class=button href=updateInfo.php >Edit</a>
						</td>
						</tr>
						
						<tr>
						<td>
							Email address:
						</td>
						<td>
							<?php
								echo $emailAddress;
							?>
						</td>
						</tr>
						
						<tr>
						<td>
							Home address:
						</td>
						<td>
						
							<?php
								echo $street;
							?><br>
							<?php
								echo $city;
							?><br>
							<?php
								echo $province;
							?><br>
							<?php
								echo $postalCode;
							?>
						</td>
						</tr>
						
						
						</table>
						</form>
						</div>
				</div>
			</div>
		
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>