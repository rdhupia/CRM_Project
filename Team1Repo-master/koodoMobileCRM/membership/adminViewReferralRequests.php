<?php
	include("../library/library.php");
$user = User::isUser();
$user->adminAccess();

$requests = ReferralRequest::getAll(true);
$viewAll="";
if($_POST){
    if($viewAll = isset($_POST['viewAll'])){
        $requests = ReferralRequest::getAll(false);
    }else if(isset($_POST['comment'])){
        $comment = $_POST['comment'];
        $isApproved = isset($_POST['approved']);
        $request = ReferralRequest::withId($_POST['id']);
        $referred = Membership::withId($_POST['referralId']);
        $referring = Membership::withId($_POST['referringId']);

        if($isApproved){
            //if approved
            //update request status
            $request->updateStatus("Approved",$comment,$user);

            //add credit to refrerring
            if($referred->isVIP()){
                $amount = 30;
            }else{
                $amount = 15;
            }
            $referred->updateBalance($amount, "+");

            //add transaction
            Transaction::addNew($user->storeCode,$user->id,"null", $amount,$referred->id,"null","Referral Credit");


            //add credit to refrerring
            if($referring->isVIP()){
                $amount = 30;
            }else{
                $amount = 15;
            }

            $referring->updateBalance($amount, "+");

            //add transaction
            Transaction::addNew($user->storeCode,$user->id,"null", $amount,$referring->id,"","Referral Credit");

        }else{
            //if not approved
            $request->updateStatus("Declined",$comment,$user);

            // update request status
        }
    //redirect
        header("location:adminViewReferralRequests.php");
    }
}


Header::write();
Menu::write("admin");
?>

    <!-- HEADER -->
    <header class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Membership
                    <small>Manage Referral</small>
                </h1>
            </div>
        </div>
    </header>
<?php if($requests == null){ ?>
    <div class="row text-center">
        <form  method="POST">
            <input type="submit" value="<?php print $viewAll ? "View Requested" : "View All";?>" class="btn btn-default">
            <input type="hidden" name="<?php print $viewAll ? "View Requested" : "viewAll";?>">
        </form>
        <h3>No referral request record found. Click View All to view all processed requests</h3>
    </div>
<?php }else{ ?>
    <!-- /HEADER -->
    <!-- MAIN CONTENT -->
    <div class="main-content container">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Requested Date</td>
				<td>Requested By</td>
				<td>Memb. ID Requested</td>
				<td>Memb. ID Referred</td>
				<td>Phone Number</td>
				<td>Account Number</td>
				<td>Status</td>
                <td>Comment</td>
				<td>

                    <form  method="POST">
                        <input type="submit" value="<?php print $viewAll ? "View Requested" : "View All";?>" class="btn btn-default">
                        <input type="hidden" name="<?php print $viewAll ? "View Requested" : "viewAll";?>">
                    </form></td>

			</tr>
		</thead>
		<tbody>
        <?php   foreach ($requests as $request) {?>
            <tr>
                <td><?php print substr($request->timestamp,0,10);?></td>
                <td><?php print User::getUserNameWihtId($request->userId);?></td>
                <td><?php print $request->referringId;?></td>
                <td><?php print $request->referralId;?></td>
                <td><?php print $request->phoneNumber;?></td>
                <td><?php print $request->accountNumber;?></td>
                <td><?php print $request->status;?></td>
                <td><?php print $request->comment;?></td>
                <td><?php if($request->isRequested()){ ?>
                    <form class="form" method="post">
                        <div class="form-group">
                            <input class="form-control" name="comment" placeholder="comment" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-success" value="Approve" name="approved">
                            </div>
                            <input type="hidden" name="id" value="<?php print $request->id;?>">
                            <input type="hidden" name="referringId" value="<?php print $request->referringId;?>">
                            <input type="hidden" name="referralId" value="<?php print $request->referralId;?>">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-danger" value="Decline">
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </td>
            </tr>
        <?php   }
        ?>
			<tr>
		</tbody>
	</table>
</div>
    <?php } ?>
	<!-- /MAIN CONTENT -->

<?php
Footer::write();
?>