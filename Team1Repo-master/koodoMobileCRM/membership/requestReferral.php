<?php
	include("../library/library.php");
    $user = User::isUser();
    $membership;
$errMsg="";

if(isset($_GET['membershipId']) && isset($_GET['hash'])){
    $membershipId = $_GET['membershipId'];

    //Security Check!
    if(!Membership::isValidHash($membershipId, $_GET['hash'])){
        //if not get..
        print "Invalid access tried from viewMembership";
        exit();
    }

    $membership = Membership::withId($membershipId);
}



if($_POST) {
    $referringId = $_POST['membershipIdGuest'];
    $accountNumber = $_POST['accountNumber'];
    $phoneNumber = $_POST['phoneNumber'];
    if (!Membership::isExist($referringId)) {
        $errMsg = "<h2>Referred membership not found</h2>";
    } else if ($referringId == $membershipId) {
        $errMsg = "<h2>Referring Id and referred id can't be same</h2>";

}else{

    ReferralRequest::addNew($membershipId,$referringId,$accountNumber,$phoneNumber,$user->storeCode, $user->id);

    header("location:viewMembership.php?".$membership->redirectString());
    }
}

    Header::write();
    Menu::write("membership");
?>
    <div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Membership
                <small>Request Referral</small>
            </h1>

        </div>
    </div><!-- /HEADER -->
<!-- MAIN CONTENT -->
<div class="main-content container-fluid">
    <?php print $errMsg;?>
	<form class="form-horizontal" method="POST">
		<div class="form-group" method="POST">
			<label class="control-label  col-md-4">Membership Id (Referring)</label>
			<div class="col-md-4">
				<input class="form-control" placeholder="Membership Id" name="membershipIdRegistered"  maxlength="6" readonly value="<?php print $membership->id;?>">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Membership Id (Reffered)</label>
			<div class="col-md-4">
				<input class="form-control" placeholder="Membership Id" name="membershipIdGuest"  maxlength="6" required pattern="[\d]{6}" title="6 numberic digits only.">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Phone Number (Reffered)</label>
			<div class="col-md-4">
				<input class="form-control" placeholder="Phone Number" name="phoneNumber"  maxlength="10" required pattern="[\d]{10}" title="10 numeric digits only">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label  col-md-4">Account Number (Reffered)</label>
			<div class="col-md-4">
				<input class="form-control" placeholder="Account Number" name="accountNumber"  maxlength="10" required>
			</div>
		</div>

		<div class="form-group">
            <div class="col-md-1">

            </div>
            <div class="col-md-3"></div>
			<div class="col-md-4">
                <input type="submit" value="Submit" class="btn btn-primary form-control">

			</div>
		</div>

	</form>

    <div class="row">
        <a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
    </div>
</div>

    </div>
<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>