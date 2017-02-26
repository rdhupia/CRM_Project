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
		<h2>Manage Credit Requests</h2>
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
					<input class="form-control" name="balance" id="balance"  value="15">
				</div>
			</div>
		</div>	
		
		<div class="form-group">
			<label class="control-label  col-md-4">Status</label>
			<div class="col-md-4">
				<select class="form-control" name="status" required>
					<option value="">--Select Status--</option>
					<option value="">Approved</option>
					<option value="">Declined</option>
					<option value="">Cancelled</option>
				</select>
			</div>
		</div>	
		
		
		<div class="form-group">
			<label class="control-label  col-md-4">Comment</label>
			<div class="col-md-4">
				<input class="form-control" name="comment"   placeholder="comment">
			</div>
		</div>	
		
		<div class="form-group">
			<label class="col-md-4"></label>
			<div class="col-md-4">
				<a href="adminViewCreditRequests.php" class="form-control btn btn-primary">Update</a>
			</div>
		</div>
	
	
</div>
<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>