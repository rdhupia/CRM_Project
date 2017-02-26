<?php
include("../library/library.php");
// Get current user object
$user = User::isUser();

$menu = new Menu();
$header = new Header();
$footer = new Footer();

//vars
$customerId = '';
$koodoAccountId = '';

//if form is submitted with POST handle addition (Add or Edit)
if($_POST){	
	//Check if customer exists in the database
	//Customer is unique if name, email and phone number are unique
	$email = htmlentities(trim($_POST['email']));
	$firstName = htmlentities(trim($_POST['firstName']));
	$lastName = htmlentities(trim($_POST['lastName']));
	$phoneNumber = htmlentities(trim($_POST['phoneNumber']));
	$phoneNumber2 = htmlentities(trim($_POST['phoneNumber2']));
    
    // Function returns customerId if method exists, else returns false
    $customer = Customer::isExist($email, $firstName, $lastName, $phoneNumber);
        // If customer doesn't exist, add address
        if( $customer === false )
        {
            $city = htmlentities(trim($_POST['city']));
            $postalCode = htmlentities(trim($_POST['postalCode']));
            $province = htmlentities(trim($_POST['province']));
            $street = htmlentities(trim($_POST['street']));   
            
            $addressId = Address::addNew($street, $city, $province, $postalCode);
            
            // Add the new customer
            $customerId = Customer::addNew($addressId, $email, $firstName, $lastName, 
            $phoneNumber, $phoneNumber2);
        }
    else {
        $customerId = $customer;   
    }
        	
	// Check if a KoodoAccount exists for the accountNumber
	$accountNumber = htmlentities(trim($_POST['accountNumber']));
    $koodoAccount = KoodoAccount::isExist($accountNumber);
        // Koodo Account doesn't exist, add a new one
        if( $koodoAccount === false )     {
            $accountPin = htmlentities(trim($_POST['accountPin']));
		    $billingCycle = htmlentities(trim($_POST['billingCycle']));
            $koodoAccountId = KoodoAccount::addNew($customerId, $accountNumber, $accountPin, $billingCycle);                            
        }
    else  {
        // Account exists, get KoodoAccount ID
        $koodoAccountId = $koodoAccount;
    }
    
	//Create New KoodoService, get koodoServiceId
    $saleStatus = 'sold';
	$addOn = htmlentities(trim($_POST['addOn']));
	$giftCardUsed = htmlentities(trim($_POST['giftCardUsed']));
	$imeiNumber = htmlentities(trim($_POST['imeiNumber']));
	$modelCode = htmlentities(trim($_POST['modelCode']));
	$plan = htmlentities(trim($_POST['plan']));
	$simNumber = htmlentities(trim($_POST['simNumber']));
	$tab = htmlentities(trim($_POST['tab']));
	$phoneNumber = htmlentities(trim($_POST['phoneNumber']));
    
	$koodoServiceId = KoodoService::addNew($phoneNumber, 
    $imeiNumber, $simNumber, $giftCardUsed, $plan, $addOn, $tab, 
    $modelCode, $koodoAccountId, $saleStatus);
	
	//Add a new Sale, get saleId of the new sale
	$primaryIdCode = htmlentities(trim($_POST['primaryIdCode']));
	$secondaryIdCode = htmlentities(trim($_POST['secondaryIdCode']));
	
	$storeCode = $user->storeCode; // Will be getting it from the _SESSION 
	$typeCode = htmlentities(trim($_POST['typeCode']));
	$userId = htmlentities(trim($_POST['userId']));
	
	$saleId = Sale::addNew($userId, $typeCode, $koodoServiceId, 
    $storeCode, $primaryIdCode, $secondaryIdCode );
	
	//Create new SalesStatus for the Sale!!
	$saleStatusId = SaleStatus::addNew($saleStatus, $userId, $saleId);			
				
	//Add Comment
	$context = htmlentities(trim($_POST['context']));
	$commentId = Comment::addNew($context, $userId, $saleId);
	
	//Redirect to Daily Sales View!
	header("location:viewDailySales.php");
    exit();
}

$header->writeHeader();
$menu->writeMenu("sale");
?>
	
<!-- HEADER -->
<header class="container">
	<div class="row">
		<h2>Add New Sale</h2>
	</div>
</header>
<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
		
			<form class="form-horizontal" method="POST">
				<h3>Customer Information</h3>
				<!--Row 1-->
				<div class="form-group">
					<!--First Name-->
					<label class="col-sm-2 control-label" for="cusFirstName">First Name</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusFirstName" placeholder="First Name" 
							name="firstName" required pattern="^[\D'.-]+$" title="Invalid Character Found">
					</div>
					
					<!--Last Name-->
					<label class="col-sm-2 control-label" for="cusLastName">Last Name</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusLastName" placeholder="Last Name"
							name="lastName" required pattern="^[\D'.-]+$" title="Invalid Character Found">
					</div>
				</div>
				
				<!--Row 2-->
				<div class="form-group">
					<!--Address-->
					<label class="col-sm-2 control-label" for="cusAddress">Address</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAddress" placeholder="Address"
							name ="street" title="Invalid Character Found">
					</div>
					
					<!--City-->
					<label class="col-sm-2 control-label" for="cusCity">City</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cusCity" placeholder="City"
							name="city" required pattern="^[\D'.-]+$" title="Invalid Character Found">
					</div>
					
					<!-- Province -->
					<div class="col-sm-2">
						<select class="form-control" name="province" id="cusProvince">
							<option value="AB">Alberta</option>
							<option value="BC">British Columbia</option>
							<option value="MB">Manitoba</option>
							<option value="NB">New Brunswick</option>
							<option value="NL">Newfoundland and Labrador</option>
							<option value="NS">Nova Scotia</option>
							<option value="ON" selected>Ontario</option>
							<option value="PE">Prince Edward Island</option>
							<option value="QC">Quebec</option>
							<option value="SK">Saskatchewan</option>
							<option value="NT">Northwest Territories</option>
							<option value="NU">Nunavut</option>
							<option value="YT">Yukon</option>
						</select>
					</div>
				</div>

				<!-- Row 3-->
				<div class="form-group">
					<!--Postal Code-->
					<label class="col-sm-2 control-label" for="cusPostalCode">Postal Code</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusPostalCode" placeholder="M0M0M0" 
							name="postalCode" required pattern="^([a-zA-Z]\d[a-zA-Z]( )?\d[a-zA-Z]\d)$" title="Invalid Format" maxlength="6">
					</div>
					
					<!--ID Information-->
					<label class="col-sm-2 control-label" for="cusPostalCode">I.D. Used</label>
                    
					<div class="col-sm-2"> 
						<select class="form-control" id="primaryId" name="primaryIdCode" required>
							<option value="">-- Select ID -- </option>
							<?php
                                //Model List from DB
								$result = Identification::getAllCodesDescriptions("primary");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>"><?php print $row['description'];?>  </option>	
						<?php	}
							?>
						</select>
					</div>
					
					<!-- Secondary Info-->
					<div class="col-sm-2">
						<select class="form-control" name="secondaryIdCode" required>
							<option value="">-- Select ID -- </option>					
							<?php
								//Model List from DB
								$result = Identification::getAllCodesDescriptions("Secondary");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>"><?php print $row['description'];?>  </option>	
						<?php	}
							?>
						</select>
					</div>
				</div>
				
				<hr>
				
				<h3>Product Information</h3>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusPhoneNumber">Phone Number</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cusPhoneNumber" placeholder="##########"
							name="phoneNumber" required pattern="^\d{10}$" title="Phone number must be 10 numeric digits" maxlength="10">
					</div>
					
					<label class="col-sm-1 control-label" for="cusIMEI">IMEI</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="cusIMEI" placeholder="15 digit IMEI"
						name="imeiNumber" pattern="^\d{15}$" title="IMEI must be 15 numeric digits" maxlength="15">
					</div>
					<label class="col-sm-1 control-label" for="cusSIM">SIM</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="cusSIM" placeholder="19 digit SIM"
						name="simNumber" required pattern="^\d{19}$" title="SIM number must be 19 numeric digits" maxlength="19">
					</div>
				</div>
				

				<div class="form-group">	
					<!-- SALES TYPE -->
					<label class="col-sm-2 control-label" for="cusPhoneNumber">Sale Type</label>
					<div class="col-sm-2">
						<select class="form-control" id="sales_type"
						name="typeCode" required>
							<option value="">-- Select Type --</option>
							<optgroup label="Postpaid Services">
								<?php
								$result = Type::getAllCodesDescriptions("Postpaid Service");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>"><?php print $row['description'];?>  </option>	
						<?php	}
							?>
							</optgroup>
							<optgroup label="Prepaid Services">						
								<?php
								$result = Type::getAllCodesDescriptions("Prepaid Service");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>"><?php print $row['description'];?>  </option>	
						<?php	}
							?>
							</optgroup>
						</select>
					</div>
					
					<!-- /SALES TYPE -->
					
					<!-- MODEL TYPE -->
					<label class="col-sm-1 control-label" for="cusPhoneNumber">Model</label>
					<div class="col-sm-3">
						<select class="form-control" id="sales_type"
						name="modelCode" required>
							<option value="">-- Select Model --</option>
							<?php
                                // Get result set of all Models' Codes
                                $result = Model::getAllCodes();
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option> <?php print $row['code'];?> </option>	
						<?php	}
							?>
						</select>
					</div>
					<!-- /MODEL TYPE -->
					
					<!-- TAB -->
					<label class="col-sm-1 control-label" for="tabRadios">Tab</label>
					<div class="col-sm-3">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="userLoggedIn" placeholder="Tab Amount"
								name="tab" required min="0" max="504" >
						</div>
					</div>
				</div>
				
					
				
				<div class="form-group billingInputs">
					<label class="col-sm-2 control-label" for="userLoggedIn">Employee</label>
					<div class="col-sm-2">
						<select class="form-control" name="userId">
							<?php
								//Model List from DB
								$result = User::getAllUsers();
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['id'];?>"><?php print $row['userName'];?>  </option>	
						<?php	}
							?>
						</select>
					</div>
					<label class="col-sm-1 control-label" for="tabRadios">Plan</label>
					<div class="col-sm-3">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="userLoggedIn" placeholder="Plan"
								name="plan" min="0" max="120">
						</div>
					</div>
					<label class="col-sm-1 control-label" for="tabRadios">Add-On</label>
					<div class="col-sm-3">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="userLoggedIn" placeholder="Add-On" 
							name="addOn" min="0" max="40" >
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="prodBillingCycle">Billing Cycle</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" id="userLoggedIn" placeholder="Billing Cycle"
							name="billingCycle" min="1" max="31">
					</div>
					
					<label class="col-sm-1 control-label" for="giftCardRadios">Gift Card</label>
					<div class="col-sm-3" id="giftCardRadios">
						<label class="radio-inline">
							<input type="radio" name="giftCardUsed" id="giftRadio1" value="N/A" required> N/A
						</label>
						<label class="radio-inline">
						  <input type="radio" name="giftCardUsed" id="giftRadio2" value="YES"> Yes
						</label>
						<label class="radio-inline">
						  <input type="radio" name="giftCardUsed" id="giftRadio3" value="NO"> No
						</label>
					</div>
				</div>
				
				<hr>
				
				<h3>Additional Information</h3>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusEmail">E-Mail</label>
					<div class="col-sm-4">
						<input type="email" class="form-control" id="cusEmail" placeholder="E-Mail Address"
						name="email">
					</div>
					
					<label class="col-sm-2 control-label" for="cusAltCon">Alternate Contact</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAltCon" placeholder="Alternate Phone Number"
						name="phoneNumber2" pattern="^\d{10}$" title="Phone number must be 10 numeric digits" maxlength="10">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusAccNum">Account Number</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAccNum" placeholder="Account Number"
						name="accountNumber" required pattern="^\d{10}$" title="Account number must be 10 numeric digits" maxlength="10">
					</div>
					<label class="col-sm-2 control-label" for="cusAccPin">Account PIN</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAccPin" placeholder="Account PIN"
						name="accountPin" pattern="^\d{4}$" title="PIN number must be 4 numeric digits" maxlength="4">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusAccPin">Comment</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="3" placeholder="Comments" name="context"></textarea>
					</div>
				</div>
				
				
				<div class="form-group">
					<div class="col-sm-4"></div>
					<div class="  col-sm-4">
					<input type="submit" role="button" class="form-control btn btn-primary" value="Add Sale">
					</div>
				</div>
				
			</form>
			
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>