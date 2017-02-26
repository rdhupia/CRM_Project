<?php
	include("../library/library.php");
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("membership");
	?>

<!-- HEADER -->
<header class="container">
	<div class="row">
		<h2>Update Membership Balance</h2>
	</div>
</header>
<!-- /HEADER -->
<!-- MAIN CONTENT -->
<div class="main-content container-fluid">			
	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label class="control-label  col-md-4">Membership Id</label>
			<div class="col-md-4">
				<input class="form-control" name="membershipId"  maxlength="6" readonly value="100001">
			</div>
		</div>	
		
		<div class="form-group">
			<label class="control-label  col-md-4">Balance</label>
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input class="form-control" name="balance" id="balance" readonly  value="0">
				</div>
			</div>
		</div>	
	
		<div class="form-group">
			<label class="control-label  col-md-4">Type</label>
			<div class="col-md-4">			
				<select  oninput="membershipBalanceUpdateType(this)" id="type" required class="form-control" name="type">
					<option value="">Select Type</option>
					<option value="y">Addition Request</option>
					<option value="n">Redemption</option>
				</select>		
			</div>
		</div>
						
		<div class="form-group">
			<label class="control-label  col-md-4">Amount</label>
				<div class="col-md-4">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="numbers" required min="1" id="balChange" name="balChange" class="form-control" oninput="compareBalance(this)">
					</div>
				</div>
			</div>	
				
		<div class="form-group">
			<label class="control-label  col-md-4">Cello Transaction Number</label>
			<div class="col-md-4">
				<input class="form-control"  id="celloId" placeholder="Cello Transaction Number" maxlength="13" name="celloId" pattern="[\d]{13}" title="Cello T.N. must be 13 numeric digits only.">
			</div>
		</div>
					
		<div class="form-group">
			<label class="control-label  col-md-4">Username</label>
			<div class="col-md-4">
				<input class="form-control" readonly name="userName"   maxlength="5" value="EDC">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Password</label>
			<div class="col-md-4">
				<input class="form-control" placeholder="Password" id="password" name="password"   type="password"  maxlength="5" required pattern="[a-zA-Z0-9]{3,5}" title="3 to 5 alpha, numeric digits only">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Comment</label>
			<div class="col-md-4">
				<input class="form-control" id="comment" placeholder="Reason for addition request" name="comment" required>
			</div>
		</div>
	
		
		<div class="form-group">
			<label class="col-md-4"></label>
			<div class="col-md-4">
				<a href="viewMembership.php" class="form-control btn btn-primary">Update</a>
			</div>
		</div>
	</form>		
</div>
<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>















