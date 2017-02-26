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
				<h2>Sale Details</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
		<div class="col-md-10">
			<table class="table  table-striped table-bordered">
				<tr>
					<td class="col-md-2">Sale Id: </td>
					<td class="col-md-2"></td>
					<td class="col-md-2">Employee: </td>
					<td class="col-md-2"></td>
					<td class="col-md-2">Location: </td>
					<td class="col-md-2"></td>

				</tr>
			</table>
			<table class="table   table-striped table-bordered">
			<h3>Customer Information</h3>
				<tr>
					<td class="col-md-2">First Name: </td>
					<td class="col-md-2"></td>
					<td class="col-md-2">Last Name:</td>
					<td class="col-md-2"></td>
					<td class="col-md-2">Account Number: </td>
					<td class="col-md-2"></td>
					
				</tr>
				<tr>
					<td>Address: </td>
					<td colspan="3"></td>
					<td>City: </td>
					<td></td>
				</tr>
				<tr>
					<td>Province:  </td>
					<td></td>
					<td>Postal Code: </td>
					<td></td>
					<td>E-Mail: </td>
					<td></td>
				</tr>
				<tr>
					<td>Primary ID: </td>
					<td></td>
					<td>Photo ID: </td>
					<td></td>
					<td>Alternate Phone: </td>
					<td></td>
				</tr>
			</table>
			<table class="table  table-striped table-bordered">	
			<h3>Product Information</h3>
				<tr>
					<td class="col-md-2">Phone Number: </td>
					<td class="col-md-2"></td>
					<td class="col-md-2">IMEI Number: </td>
					<td class="col-md-2"></td>
					<td class="col-md-2">SIM Number: </td>
					<td class="col-md-2"></td>
				</tr>
				<tr>
					<td>Sale Type: </td>
					<td></td>
					<td>Model Type: </td>
					<td></td>
					<td>Tab: </td>
					<td></td>
				</tr>
				<tr>
					<td>Price Plan: </td>
					<td></td>
					<td>Add On: </td>
					<td></td>
					<td>Gift Card</td>
					<td></td>
				</tr>
				<tr>
					<td>Billing Cycle: </td>
					<td></td>
					<td>Bill Type: </td>
					<td></td>
					<td>Comments: </td>
					<td></td>
				</tr>
				
			</table>
		</div>	
		
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-6">
				<a class="btn btn-success btn-lg" href="viewSalesAdmin.php" role="button">Go Back</a>	
			</div>
		</div>
		
		</div>
		<!-- /MAIN CONTENT -->
		
					<!-- <button type="submit" class="btn btn-success btn-lg">Add Sale</button> -->
		

<?php
	$footer->writeFooter();
?>

