<?php
	include("../library/library.php");
	$user = User::isUser();
    
    //Variable required for page operation
	$membershipId;
       
	if($_POST){
		//If the post request is from the addNewMembershipMessage page...
		if(isset($_POST['firstProcess'])){
			$membershipId = $_POST['membershipId'];
            if(Membership::isExist($membershipId)){
                $membership = Membership::withId($membershipId);
                header("location:viewMembership.php?".$membership->redirectString());
            }
		}else{
			//---- Process Addition request ----
			
			//---- Get All Variables from POST
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$phoneNumber = $_POST['phoneNumber'];
			$email = $_POST['email'];
			$city = $_POST['city'];
			$province = "ON";
			$postalCode = $_POST['postalCode'];
            $street = $_POST['street'];
			$membershipId = $_POST['membershipId'];
			$balance = $_POST['balance'];
			$emailPassword = $_POST['emailPassword'];
			$isVIP = $_POST['isVIP'];
			$celloNumber = $_POST['celloNumber'];

			//-- Search for existing customer
			$customerId = Customer::isExist($email, $firstName, $lastName, $phoneNumber);
			
			//-- Customer is not exist, add new address
			if($customerId == false){
				//Add new address and get addressId
				$addressId = Address::addNew($street, $city, "ON", $postalCode);
				
				//Add new customer and assign customerId -- alternative phone number is empty string
				$customerId = Customer::addNew($addressId, $email, $firstName, $lastName, $phoneNumber, "");
			}
			
			// -- Add new membership
			Membership::addNew($customerId, $membershipId, $emailPassword);
			
			// -- IF VIP SET, activate VIP
			if($isVIP == "true"){
				$membership = Membership::withId($membershipId);
				$membership->activateVIP();
			}
			
			// -- Add Transaction if balance IS NOT 0
			if($balance > 0){
				//Information will be available once employee module is working..
				//Getting storeCode, userId...
                $membership = Membership::withId($membershipId);
                $membership->updateBalance($balance,"+");
				Transaction::addNew($user->storeCode, $user->id, "null", $balance, $membershipId, $celloNumber, "Activation Credit");
			}
			
			//-- Redirect to view membership detail of just added
            header("location:viewMembership.php?".$membership->redirectString());
		}
	}else{
		//Invalid access && Logout
		//Need to implement later
		print "ERROR - Invalid access without POST access addMembership.php at line 68";
		exit();
	}

	Header::write();
	Menu::write("membership");
?>
    <div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Membership
                <small>Add New</small>
            </h1>

        </div>
    </div>
	<!-- MAIN CONTENT -->
	<div class="main-content container-fluid">
		<form class="form-horizontal" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="col-md-12">
						<h3 class="">Customer Information</h3><br>
					</div>
					
					<div class="form-group">
						<label class="control-label  col-md-4">First Name</label>
						<div class="col-md-8">
							<input class="form-control" name="firstName" placeholder="First Name"  required >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label  col-md-4">Last Name</label>
						<div class="col-md-8">
							<input class="form-control" name="lastName"  placeholder="Last Name"  required >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-4">Phone Number</label>
						<div class="col-md-8">
							<input class="form-control" name="phoneNumber" placeholder="Phone Number" maxlength="10" required  >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label  col-md-4">Address</label>
						<div class="col-md-8">
							<input class="form-control" placeholder="Street Number & Street Name" name="street"  required  >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label  col-md-4">City</label>
						<div class="col-md-8">
							<input class="form-control" placeholder="City" name="city" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label  col-md-4">Postal Code</label>
						<div class="col-md-8">
							<input class="form-control" placeholder="Postal Code" name="postalCode" required>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-12">
						<h3>Membership Information</h3><br>
					</div>
					<div class="form-group">
						
						<label class="control-label col-md-4">Membership Id</label>
						<div class="col-md-8">
							<input class="form-control" value="<?php print $membershipId;?>" readonly name="membershipId" placeholder="Membership Id" maxlength="6" >
						</div>
					</div>	
				
					<div class="form-group">
						<label class="control-label  col-md-4">Initial Balance</label>
						<div class="col-md-8">
						<div class="input-group">
							<div class="input-group-addon">$</div>
							<input class="form-control" id="balance" oninput="balanceChange(this)" placeholder="Balance" name="balance" type="number" min="0">
							</div>			
						</div>
					</div>				
														
					<div class="form-group">
						<label class="control-label  col-md-4">Email</label>
						<div class="col-md-8">
							<input class="form-control" name="email"  type="email" >
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-4">Email Password</label>
						<div class="col-md-8">
							<input class="form-control" name="emailPassword"  maxlength="40">
						</div>
					</div>
					
					
					
					<div class="form-group">
						<label class="control-label  col-md-4">VIP Status</label>
						<div class="col-md-8">
							<select name="isVIP" class="form-control" required oninput="VIPType(this)">
								<option value=''>--Select VIP Status--</option>
								<option value="true">YES</option>
								<option value="false">NO</option>
							</select>
						</div>
					</div>
						
					<div class="form-group">
						<label class="control-label  col-md-4">Cello Transaction Number</label>
						<div class="col-md-8">
							<input class="form-control"  id="celloNumber" placeholder="Cello Transaction Number" maxlength="13" name="celloNumber" >
						</div>
					</div>
					
					
				</div>
			</div>
			<div class="form-group">
                <div class="col-md-4">
                    <!--<input class="form-control" type="submit" value="Submit">-->
                    <a class="btn btn-danger" href="addMembershipInit.php">Back</a>

                </div>
				<div class="col-md-4 col-md-offset-4">
					<!--<input class="form-control" type="submit" value="Submit">-->
					<input type="submit" value="Add" class="btn btn-primary col-md-12"/>
					
				</div>
			</div>
		</form>
    </div>
</div>
	<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>