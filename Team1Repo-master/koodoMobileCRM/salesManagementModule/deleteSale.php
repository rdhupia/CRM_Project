<?php
	//This is Page Template
	include("../library/library.php");
    // Get current user object
    $user = User::isUser();
    
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
   
    
    //vars
    $customerInstance;
    $koodoAccountInstance;
    $addressInstance;
    $customerId = '';
    $koodoAccountId = '';
    $employee = "";
    $location = "";
    $cusFirstName = "";
    $cusLastName = "";
    $accountNumber = "";
    $street = "";
    $city = "";
    $province = "";
    $postalCode = "";
    $email = "";
    $primaryId = "";
    $secondaryId = "";
    $alterPhone = "";
    $phoneNumber = "";
    $phoneNumber2 = "";
    $imeiNumber = "";
    $simNumber = "";
    $saleType = "";
    $modelCode = "";
    $tab = "";
    $plan = "";
    $addON = "";
    $giftCardUsed = "";
    $billingCycle = "";
    $comment = "";
    $accountPin = "";
    $userId = "";
    $koodoServiceId = "";
    $saleId = "";

 if($_GET) {
        if( isset($_GET['sId']) && isset($_GET['ksId']) && isset($_GET['uid']) ) {
            $saleId = htmlentities($_GET['sId']);
            $koodoServiceId = htmlentities($_GET['ksId']);
            $userId = htmlentities($_GET['uid']);
            
            $userInstance = User::withId($userId);
            $employee = $userInstance->firstName ." ".$userInstance->lastName;
                 
            // Populate table with info about the sale, customer, account, service     
            $koodoServiceInstance = KoodoService::withId($koodoServiceId);
            $koodoAccountId = $koodoServiceInstance->koodoAccountId;
            
            $phoneNumber = $koodoServiceInstance->phoneNumber;
            $imeiNumber = $koodoServiceInstance->imeiNumber;
            $simNumber = $koodoServiceInstance->simNumber;
            $modelCode = $koodoServiceInstance->modelCode;
            $tab = $koodoServiceInstance->tab;
            $plan = $koodoServiceInstance->plan;
            $addON = $koodoServiceInstance->addOn;
            $giftCardUsed = $koodoServiceInstance->giftCardUsed;
            
            $koodoAccountInstance = KoodoAccount::withId($koodoAccountId);
            $customerId = $koodoAccountInstance->customerId;
            $accountNumber = $koodoAccountInstance->accountNumber;
            $billingCycle = $koodoAccountInstance->billingCycle;
            
            $customerInstance = Customer::withId($customerId);
            $cusFirstName = $customerInstance->firstName;
            $cusLastName = $customerInstance->lastName;
            $email = $customerInstance->email;
            $addressId = $customerInstance->addressId;
            $alterPhone = $customerInstance->phoneNumber2;
            
            $addressInstance = Address::withId($addressId);
            $street = $addressInstance->street;
            $city = $addressInstance->city;
            $province = $addressInstance->province;
            $postalCode = $addressInstance->postalCode;
            
            $saleInstance = Sale::withId($saleId);
            $primaryIdCode = $saleInstance->primaryIdCode;
            $secondaryIdCode = $saleInstance->secondaryIdCode;
            $typeCode = $saleInstance->typeCode;
            $storeCode = $saleInstance->storeCode;
            
            $typeInstance = Type::withId($typeCode);
            $saleType = $typeInstance->description;
            
            $storeInstance = Store::withId($storeCode);
            $location = $storeInstance->storeName;
            
            $idenInstance1 = Identification::withId($primaryIdCode);
            $primaryId = $idenInstance1->description;
            $idenInstance2 = Identification::withId($secondaryIdCode);
            $secondaryId = $idenInstance2->description;
            
            $comment = Comment::getCommentForSale($saleId);
        }
 }
 
//if form is submitted with POST handle addition (Add or Edit)
if($_POST){	 
    $newStatus = "delete";   
    // Get comment
    $context = htmlentities(trim($_POST['context']));
    $link = "location:viewDailySales.php";
    
    // If delete use case
    if(isset($_POST['delete'])) {
        $context = "Deleted: ".$context;
    }
    
    // If process return use case
    if(isset($_POST['return'])) {
        $newStatus = "returned";
        $context = "Returned: ".$context;
        $link = "location:../membership/searchResult.php";
    }
        // Update sale status to deleted in saleStatus and KoodoService tables
        $userId = $user->id;
        SaleStatus::updateSaleStatus($saleId, $userId, $newStatus);
        $saleInstance = Sale::withId($saleId);
        $koodoServiceId = $saleInstance->koodoServiceId;
        $koodoServInstance = KoodoService::withId($koodoServiceId);
        $koodoServInstance->updateSaleStatus($newStatus);
        
        //Add Reason for deletion
        $commentId = Comment::addNew($context, $userId, $saleId);
      
        //Redirect to Daily Sales View!
        header($link);
        exit();
}
	$header->writeHeader();
	$menu->writeMenu("sale");
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Change Sale Status</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
		
			<form class="form-horizontal" method="POST">
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusSaleId">Sale Id: </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cusSaleId" value="<?php print $saleId; ?>" readonly>
					</div>
				</div>
                
                <h3>Customer Information</h3>
				<!--Row 1-->
				<div class="form-group">
					<!--First Name-->
					<label class="col-sm-2 control-label" for="cusFirstName">First Name</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusFirstName" placeholder="First Name" 
							name="firstName" required pattern="^[\D'.-]+$" title="Invalid Character Found" value="<?php print $cusFirstName; ?>" readonly>
					</div>
					
					<!--Last Name-->
					<label class="col-sm-2 control-label" for="cusLastName">Last Name</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusLastName" placeholder="Last Name"
							name="lastName" required pattern="^[\D'.-]+$" title="Invalid Character Found" value="<?php print $cusLastName; ?>" readonly>
					</div>
				</div>
				
				<!--Row 2-->
				<div class="form-group">
					<!--Address-->
					<label class="col-sm-2 control-label" for="cusAddress">Address</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAddress" placeholder="Address"
							name ="street" title="Invalid Character Found" value="<?php print $street; ?>" readonly>
					</div>
					
					<!--City-->
					<label class="col-sm-2 control-label" for="cusCity">City</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cusCity" placeholder="City"
							name="city" required pattern="^[\D'.-]+$" title="Invalid Character Found" value="<?php print $city; ?>" readonly>
					</div>
					
					<!-- Province -->
					<div class="col-sm-2">
						<select class="form-control" name="province" id="cusProvince" readonly>
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
					<label class="col-sm-2 control-label" for="cusPostalCode" >Postal Code</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusPostalCode" placeholder="M0M0M0" value="<?php print $postalCode; ?>"
							name="postalCode" required pattern="^([a-zA-Z]\d[a-zA-Z]( )?\d[a-zA-Z]\d)$" title="Invalid Format" maxlength="6" readonly>
					</div>
					
					<!--ID Information-->
					<label class="col-sm-2 control-label" for="cusPostalCode">I.D. Used</label>
                    
					<div class="col-sm-2"> 
						<select class="form-control" id="primaryId" name="primaryIdCode" required readonly>
							<option value="">-- Select ID -- </option>
							<?php
                                //Model List from DB
								$result = Identification::getAllCodesDescriptions("Primary");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>" <?php if($row['code'] == $primaryIdCode) echo "selected"; ?>>
                                    <?php print $row['description'];?>  </option>	
						<?php	}
							?>
						</select>
					</div>
					
					<!-- Secondary Info-->
					<div class="col-sm-2">
						<select class="form-control" name="secondaryIdCode" required readonly>
							<option value="">-- Select ID -- </option>					
							<?php
								//Model List from DB
								$result = Identification::getAllCodesDescriptions("Secondary");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>" <?php if($row['code'] == $secondaryIdCode) echo "selected"; ?>>
                                    <?php print $row['description'];?>  </option>	
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
						<input type="text" class="form-control" id="cusPhoneNumber" placeholder="##########" value = "<?php print $phoneNumber; ?>"
							name="phoneNumber" required pattern="^\d{10}$" title="Phone number must be 10 numeric digits" maxlength="10" readonly>
					</div>
					
					<label class="col-sm-1 control-label" for="cusIMEI">IMEI</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="cusIMEI" placeholder="15 digit IMEI" value = "<?php print $imeiNumber; ?>"
						name="imeiNumber" pattern="^\d{15}$" title="IMEI must be 15 numeric digits" maxlength="15" readonly>
					</div>
					<label class="col-sm-1 control-label" for="cusSIM">SIM</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="cusSIM" placeholder="19 digit SIM" value = "<?php print $simNumber; ?>"
						name="simNumber" required pattern="^\d{19}$" title="SIM number must be 19 numeric digits" maxlength="19" readonly>
					</div>
				</div>

				<div class="form-group">	
					<!-- SALES TYPE -->
					<label class="col-sm-2 control-label" for="cusPhoneNumber">Sale Type</label>
					<div class="col-sm-2">
						<select class="form-control" id="sales_type" name="typeCode" required readonly>
							<option value="">-- Select Type --</option>
							<optgroup label="Postpaid Services">
								<?php
								$result = Type::getAllCodesDescriptions("Postpaid Service");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>" <?php if($row['code']==$typeCode) echo "selected"; ?>>
                                    <?php print $row['description'];?>  </option>	
						<?php	}
							?>
							</optgroup>
							<optgroup label="Prepaid Services">						
								<?php
								$result = Type::getAllCodesDescriptions("Prepaid Service");
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option value="<?php print $row['code'];?>" <?php if($row['code']==$typeCode) echo "selected"; ?>>
                                    <?php print $row['description'];?>  </option>	
						<?php	}
							?>
							</optgroup>
						</select>
					</div>
					
					<!-- /SALES TYPE -->
					
					<!-- MODEL TYPE -->
					<label class="col-sm-1 control-label" for="cusPhoneNumber">Model</label>
					<div class="col-sm-3">
						<select class="form-control" id="sales_type" name="modelCode" required readonly>
							<option value="">-- Select Model --</option>
							<?php
                                // Get result set of all Models' Codes
                                $result = Model::getAllCodes();
								while($row = mysqli_fetch_assoc($result))
								{?>
									<option <?php if($row['code']==$modelCode) echo "selected"; ?>> <?php print $row['code'];?> </option>	
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
								name="tab" required min="0" max="504" value = "<?php print $tab; ?>" readonly>
						</div>
					</div>
				</div>
					
				
				<div class="form-group billingInputs">
					<label class="col-sm-2 control-label" for="userLoggedIn">Employee</label>
					<div class="col-sm-2">
							<input type="text" class="form-control" id="userLoggedIn" placeholder="Employee"
								name="userId" value = "<?php print $employee; ?>" readonly>
					</div>
					<label class="col-sm-1 control-label" for="tabRadios">Plan</label>
					<div class="col-sm-3">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="userLoggedIn" placeholder="Plan"
								name="plan" min="0" max="120"  value = "<?php print $plan; ?>" readonly>
						</div>
					</div>
					<label class="col-sm-1 control-label" for="tabRadios">Add-On</label>
					<div class="col-sm-3">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="userLoggedIn" placeholder="Add-On" 
							name="addOn" min="0" max="40"  value = "<?php print $addON; ?>" readonly>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="prodBillingCycle">Billing Cycle</label>
					<div class="col-sm-2">
						<input type="number" class="form-control" id="userLoggedIn" placeholder="Billing Cycle"
							name="billingCycle" min="1" max="31"  value = "<?php print $billingCycle; ?>" readonly>
					</div>
					
					<label class="col-sm-1 control-label" for="giftCardRadios">Gift Card</label>
					<div class="col-sm-3" id="giftCardRadios" >
						<label class="radio-inline">
							<input type="radio" name="giftCardUsed" id="giftRadio1" value="N/A" > N/A
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
						name="email"  value = "<?php print $email; ?>" readonly>
					</div>
					
					<label class="col-sm-2 control-label" for="cusAltCon">Alternate Contact</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAltCon" placeholder="Alternate Phone Number" value = "<?php print $phoneNumber2; ?>"
						name="phoneNumber2" pattern="^\d{10}$" title="Phone number must be 10 numeric digits" maxlength="10" readonly>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusAccNum">Account Number</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAccNum" placeholder="Account Number" value = "<?php print $accountNumber; ?>"
						name="accountNumber" required pattern="^\d{10}$" title="Account number must be 10 numeric digits" maxlength="10" readonly>
					</div>
					<label class="col-sm-2 control-label" for="cusAccPin">Account PIN</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAccPin" placeholder="Account PIN" value = "<?php print $accountPin; ?>"
						name="accountPin" pattern="^\d{4}$" title="PIN number must be 4 numeric digits" maxlength="4" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusAccPin">Reasons for Deletion</label>
					<div class="col-sm-10">
						<textarea class="form-control" rows="3" placeholder="Reasons" name="context" required pattern="^[\D'.-]+$" title="Must enter a valid reason for deleting the Sale or Processing a return" ></textarea>
					</div>
				</div>
				
				<hr>
				<div class="span7 text-right">
                    
                    <?php if( (isset($_GET['ret'])) && ($_GET['ret']=='rtrn') )
                        {
                            ?>
                    <a class="btn btn-warning btn-lg" href="viewDailySales.php" name="goBack">Cancel</a>        
                    <button type="submit" class="btn btn-danger btn-lg" href="../membership/searchResult.php" name="return">Return</button>
                    <?php 
                        } else {
                            ?>        
                    <a class="btn btn-warning btn-lg" href="viewDailySales.php" name="goBack">Go Back</a>        
                    <button type="submit" class="btn btn-danger btn-lg" href="viewDailySales.php" name="delete">Delete</button>
                    <?php 
                        }
                        ?>
                    
				</div>
				
			</form>
			
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>