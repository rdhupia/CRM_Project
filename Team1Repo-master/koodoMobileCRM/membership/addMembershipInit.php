<?php
	include("../library/library.php");
	User::isUser();
	Header::write();
	Menu::write("membership");
?>

<!-- Page Content -->
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
        <form method="POST" action="addMembership.php">
							<div class="col-md-6 col-md-offset-3">
								<div class="input-group searchBar">
								  <input type="text" maxlength="6" name="membershipId" class="form-control" placeholder="Membership Number" required pattern="[\d]{6}" title="Membership number needs to be 6 numeric digits">
								  <span class="input-group-btn">
									<input type="submit"  name="firstProcess" value="search" class="btn btn-default form-control">
									
								  </span>
								 
								</div>
								<div class="text-center"></p><small>To add new membership, enter the membership number.</small></div>
							</div>
							</form>

	</div>
</div>
<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>