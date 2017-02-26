<?php
	//This is Page Template
	include("../library/library.php");
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	$header->writeHeader();
	$menu->writeMenu("admin");
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Update Sale</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
		
			<form class="form-horizontal">
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusPhoneNumber">Sale Id: </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cusSaleId" placeholder="112112" readonly>
					</div>
				</div>
				
				<h3>Product Information</h3>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusPhoneNumber">Phone Number</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cusPhoneNumber" placeholder="(xxx)xxx-xxxx">
					</div>
					<label class="col-sm-1 control-label" for="cusIMEI">IMEI</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="cusIMEI" placeholder="15 digit IMEI">
					</div>
					<label class="col-sm-1 control-label" for="cusSIM">SIM</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="cusSIM" placeholder="19 digit SIM">
					</div>
				</div>
				

				<div class="form-group">	
					<!-- SALES TYPE -->
					<div class="col-md-3 col-md-offset-2">
						<select class="form-control" name="sales_type" id="sales_type">
							<option value="">Sales Type </option>
							<optgroup label="Postpaid Services">
								<option value="K">Koodo Activation</option>
								<option value="T">Tab Redemption</option>
								<option value="D">DOA Exchanged</option>
								<option value="E">Remorse Exchanged</option>
							</optgroup>
							<optgroup label="Prepaid Services">						
								<option value="U">Unlocked Handset</option>
								<option value="P">Prepaid Handset</option>
							</optgroup>
							<optgroup label="Koodo Warranty">
								<option value="W">Warranty</option>
							</optgroup>
						</select>
					</div>
					<!-- /SALES TYPE -->
					
					<!-- MODEL TYPE -->
					<div class="col-md-3">
						<select class="form-control" name="model" id="model_type">
							<option value="none">Model</option>
							<option value="C_GS3_B">C_GS3_B</option>
							<option value="C_MTG">C_MTG</option>
							<option value="C_NOTE2">C_NOTE2</option>
							<option value="K_A392A">K_A392A</option>
							<option value="K_CORE_B">K_CORE_B</option>
							<option value="K_CORE_W">K_CORE_W</option>
							<option value="K_GS3_B">K_GS3_B</option>
							<option value="K_GS3_W">K_GS3_W</option>
							<option value="K_GS4_B">K_GS4_B</option>
							<option value="K_GS4_W">K_GS4_W</option>
							<option value="K_GS5">K_GS5</option>
							<option value="K_I4S_B">K_I4S_B</option>
							<option value="K_I4S_W">K_I4S_W</option>
							<option value="K_I5C_WH">K_I5C_WH</option>
							<option value="K_I5S_GL">K_I5S_GL</option>
							<option value="K_I6P_16GB">K_I6P_16GB</option>
							<option value="K_I6_16GB">K_I6_16GB</option>
							<option value="K_I6_64GB">K_I6_64GB</option>
							<option value="K_LGG3">K_LGG3</option>
							<option value="K_MTE_B">K_MTE_B</option>
							<option value="K_MTE_W">K_MTE_W</option>
							<option value="K_MTG">K_MTG</option>
							<option value="K_NEX5">K_NEX5</option>
							<option value="K_NOTE4">K_NOTE4</option>
							<option value="OP">OP</option>
							<option value="P_D320">P_D320</option>
							<option value="P_MTG">P_MTG</option>
							<option value="P_Y330">P_Y330</option>
							<option value="U_7024W">U_7024W</option>
							<option value="U_FIERCE2">U_FIERCE2</option>
							<option value="U_GGIO">U_GGIO</option>
							<option value="U_GS2">U_GS2</option>
							<option value="U_GS3_747">U_GS3_747</option>
							<option value="U_GS3_999">U_GS3_999</option>
							<option value="U_GS3_999_32G">U_GS3_999_32G</option>
							<option value="U_GS4">U_GS4</option>
							<option value="U_GS5">U_GS5</option>
							<option value="U_GW300">U_GW300</option>
							<option value="U_I4S">U_I4S</option>
							<option value="U_I5C">U_I5C</option>
							<option value="U_I5_32G">U_I5_32G</option>
							<option value="U_L70">U_L70</option>
							<option value="U_L90">U_L90</option>
							<option value="U_LIGHT">U_LIGHT</option>
							<option value="U_NEX4">U_NEX4</option>
							<option value="U_NOTE2">U_NOTE2</option>
							<option value="U_NOTE3">U_NOTE3</option>
							<option value="U_T599">U_T599</option>
							<option value="U_XPZ">U_XPZ</option>
							<option value="U_Y330">U_Y330</option>
							<option value="U_Z10">U_Z10</option>
							<option value="U_Z221">U_Z221</option>
						</select>
					</div>
					<!-- /MODEL TYPE -->
					
					<!-- TAB -->
					<label class="col-sm-1 control-label" for="tabRadios">Tab</label>
					<div class="col-sm-3" id="tabRadios">
						<label class="radio-inline">
							<input type="radio" name="tabRadioOptions" id="tabRadio1" value="option1"> N
						</label>
						<label class="radio-inline">
						  <input type="radio" name="tabRadioOptions" id="tabRadio2" value="option2"> S
						</label>
						<label class="radio-inline">
						  <input type="radio" name="tabRadioOptions" id="tabRadio3" value="option3"> M
						</label>
						<label class="radio-inline">
						  <input type="radio" name="tabRadioOptions" id="tabRadio4" value="option3"> L
						</label>
					</div>
					<!-- /TAB -->
				</div>
				
					
				
				<div class="form-group billingInputs">
					<label class="col-sm-2 control-label" for="userLoggedIn">Employee</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="userLoggedIn" placeholder="Employee">
					</div>
					<label class="col-sm-1 control-label" for="prodPricePlan">Price Plan</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="prodPricePlan" placeholder="Price Plan">
					</div>
					<label class="col-sm-2 control-label" for="prodAddOn">Add On</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="prodAddOn" placeholder="Add On">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" for="prodBillingCycle">Billing Cycle</label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="userLoggedIn" placeholder="0-30 days">
					</div>
					<label class="col-sm-1 control-label" for="billTypeRadios">Bill Type</label>
					<div class="col-sm-2" id="billTypeRadios">
						<label class="radio-inline">
							<input type="radio" name="tabRadioOptions" id="billTypeRadio1" value="option1"> E-Bill
						</label>
						<label class="radio-inline">
						  <input type="radio" name="tabRadioOptions" id="billTypeRadio2" value="option2"> Paper Bill
						</label>
					</div>
					<label class="col-sm-2 control-label" for="giftCardRadios">Gift Card</label>
					<div class="col-sm-3" id="giftCardRadios">
						<label class="radio-inline">
							<input type="radio" name="tabRadioOptions" id="giftRadio1" value="option1"> N/A
						</label>
						<label class="radio-inline">
						  <input type="radio" name="tabRadioOptions" id="giftRadio2" value="option2"> Yes
						</label>
						<label class="radio-inline">
						  <input type="radio" name="tabRadioOptions" id="giftRadio3" value="option3"> No
						</label>
					</div>
				</div>
				
				<hr>
				
				<h4>Additional Information</h4>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusEmail">E-Mail</label>
					<div class="col-sm-4">
						<input type="email" class="form-control" id="cusEmail" placeholder="E-Mail Address">
					</div>
					<label class="col-sm-2 control-label" for="cusAltCon">Alternate Contact</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAltCon" placeholder="Alternate Phone Number">
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-2 control-label" for="cusAccNum">Account Number</label>
					<div class="col-sm-4">
						<input type="email" class="form-control" id="cusAccNum" placeholder="Account Number">
					</div>
					<label class="col-sm-2 control-label" for="cusAccPin">Account PIN</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="cusAccPin" placeholder="Account PIN">
					</div>
				</div>
				<div class="form-group">
					<textarea class="form-control" rows="3" placeholder="Comments"></textarea>
				</div>
				
				<hr>
				<div class="span7 text-right">
					<a class="btn btn-success btn-lg" href="viewSalesAdmin.php" role="button">Update</a>
					<!-- <button type="submit" class="btn btn-success btn-lg">Add Sale</button> -->
				</div>
				
			</form>
			
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>

