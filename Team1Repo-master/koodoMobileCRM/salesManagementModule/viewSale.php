<?php
	//This is Page Template
	include("../library/library.php");
    // Get current user object
    $user = User::isUser();
    
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
    
    $employee = "";
    $saleId = "";
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
    
    if($_GET) {
        if( isset($_GET['sId']) && isset($_GET['ksId']) && isset($_GET['uid']) ) {
            $saleId = htmlentities($_GET['sId']);
            $koodoServiceId = htmlentities($_GET['ksId']);
            $userId = htmlentities($_GET['uid']);
            
            $userInstance = User::withId($userId);
            $employee = $userInstance->firstName ." ".$userInstance->lastName;
                 
            // Populate table with info about the sale, custome, account, service     
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
            $storeInstance = Store::withId($storeCode);
            $location = $storeInstance->storeName;
            
            $typeInstance = Type::withId($typeCode);
            $saleType = $typeInstance->description;
            
            $idenInstance1 = Identification::withId($primaryIdCode);
            $primaryId = $idenInstance1->description;
            $idenInstance2 = Identification::withId($secondaryIdCode);
            $secondaryId = $idenInstance2->description;
            
            $comment = Comment::getCommentForSale($saleId);
            
        } else {
            header("location: viewDailySales.php");
        }
        
    }
   	$header->writeHeader();
	$menu->writeMenu("sale");

	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Sale Details</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
		<div class="col-md-10">
			<table class="table  table-striped table-bordered">
				<tr>
					<td class="col-md-2 success">Sale Id: </td>
					<td class="col-md-2"> <?php print $saleId; ?></td>
					<td class="col-md-2 success">Employee: </td>
					<td class="col-md-2"><?php print $employee; ?></td>
					<td class="col-md-2 success">Location: </td>
					<td class="col-md-2"><?php print $location; ?></td>

				</tr>
			</table>
			<table class="table   table-striped table-bordered">
			<h3>Customer Information</h3>
				<tr>
					<td class="col-md-2 success">First Name: </td>
					<td class="col-md-2"><?php print $cusFirstName; ?></td>
					<td class="col-md-2 success">Last Name:</td>
					<td class="col-md-2"><?php print $cusLastName; ?></td>
					<td class="col-md-2 success">Account Number: </td>
					<td class="col-md-2"><?php print $accountNumber; ?></td>
					
				</tr>
				<tr>
					<td class="success">Address: </td>
					<td colspan="3"><?php print $street; ?></td>
					<td class="success">City: </td>
					<td><?php print $city; ?></td>
				</tr>
				<tr>
					<td class="success">Province:  </td>
					<td><?php print $province; ?></td>
					<td class="success">Postal Code: </td>
					<td><?php print $postalCode; ?></td>
					<td class="success">E-Mail: </td>
					<td><?php print $email; ?></td>
				</tr>
				<tr>
					<td class="success">Primary ID: </td>
					<td><?php print $primaryId; ?></td>
					<td class="success">Photo ID: </td>
					<td><?php print $secondaryId; ?></td>
					<td class="success">Alternate Phone: </td>
					<td><?php print $alterPhone; ?></td>
				</tr>
			</table>
			<table class="table  table-striped table-bordered">	
			<h3>Product Information</h3>
				<tr>
					<td class="col-md-2 success">Phone Number: </td>
					<td class="col-md-2"><?php print $phoneNumber; ?></td>
					<td class="col-md-2 success">IMEI Number: </td>
					<td class="col-md-2"><?php print $imeiNumber; ?></td>
					<td class="col-md-2 success">SIM Number: </td>
					<td class="col-md-2"><?php print $simNumber; ?></td>
				</tr>
				<tr>
					<td class="success">Sale Type: </td>
					<td><?php print $saleType; ?></td>
					<td class="success">Model Type: </td>
					<td><?php print $modelCode; ?></td>
					<td class="success">Tab: </td>
					<td><?php print $tab; ?></td>
				</tr>
				<tr>
					<td class="success">Price Plan: </td>
					<td><?php print $plan; ?></td>
					<td class="success">Add On: </td>
					<td><?php print $addON; ?></td>
					<td class="success">Gift Card</td>
					<td><?php print $giftCardUsed; ?></td>
				</tr>
				<tr>
					<td class="success">Billing Cycle: </td>
					<td><?php print $billingCycle; ?></td>
					<td class="success">Comments: </td>
					<td colspan="3"><?php print $comment; ?></td>
				</tr>
				
			</table>
		</div>	
		

                <?php if (isset($_GET['ret'])) 
                {
                    ?>
         <form action="../membership/searchResult.php" method="POST">           
         <div class="form-group">
			<div class="col-sm-offset-4 col-sm-6">
                    <input type="hidden" name="keyword" value="<?php print $_GET['ret'];?>" />
                    <button class="btn btn-success btn-lg" type="submit" role="button">Go Back</button>
            </div>
		</div>
        </form>
                     <?php 
                } else {
                ?>
         <div class="form-group">
			<div class="col-sm-offset-4 col-sm-6">
				<a class="btn btn-success btn-lg" href="viewDailySales.php" role="button">Go Back</a>
            </div>
		</div>
                <?php 
                }
                ?>	
			
		
		</div>
		<!-- /MAIN CONTENT -->
		
					<!-- <button type="submit" class="btn btn-success btn-lg">Add Sale</button> -->
		

<?php
	$footer->writeFooter();
?>