<?php
	include("../library/library.php");
    $user = User::isUser();

    $membership;
    $referralRequests;
    $creditRequests;

    if(isset($_GET['membershipId']) && isset($_GET['hash'])){
        $membershipId = $_GET['membershipId'];

        //Security Check!
        if(!Membership::isValidHash($membershipId, $_GET['hash'])){
            //if not get..
            print "Invalid access tried from viewMembership";
            exit();
        }
        $membership = Membership::withId($membershipId);
        $referralRequests = ReferralRequest::withMembershipId($membershipId);
        $creditRequests = CreditRequest::withMembershipId($membershipId);
    }

    Header::write();
    Menu::write("membership");
?>

<header class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Membership
                <small>Requests Status</small>
            </h1>
        </div>
    </div>
</header>
<div class="main-content container">
    <div class="row">
        <h3>Referral Requests</h3>
    </div>
    <div class="row">

        <?php if($referralRequests == null){ ?>
            <h5>No Referral Request Found</h5>
        <?php } else { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Requested By</th>
                    <th>Referring Id</th>
                    <th>Status</th>
                    <th>Comment</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($referralRequests as $referralRequest) { ?>
                    <tr>
                        <td><?php print substr($referralRequest->timestamp,0,10);?></td>
                        <td><?php print User::getUserNameWihtId($referralRequest->userId);?></td>
                        <td><?php print $referralRequest->referringId;?></td>
                        <td><?php print $referralRequest->status;?></td>
                        <td><?php print $referralRequest->comment;?></td>
                    </tr>
        <?php   }
                ?>
                </tbody>
            </table>
        <?php } ?>

    </div>
    <div class="row">
        <h3>Credit Requests</h3>
    </div>
    <div class="row">
        <?php if($creditRequests == null){ ?>
            <h5>No Referral Request Found</h5>
        <?php } else { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Requested By</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Comment</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($creditRequests as $creditRequest) { ?>
                    <tr>
                        <td><?php print substr($creditRequest->timestamp,0,10);?></td>
                        <td><?php print User::getUserNameWihtId($creditRequest->userId);?></td>
                        <td><?php print $creditRequest->amount;?></td>
                        <td><?php print $creditRequest->status;?></td>
                        <td><?php print $creditRequest->comment;?></td>
                    </tr>
                <?php   }
                ?>
                </tbody>
            </table>
        <?php } ?>

    </div>
    <div class="row">
		<a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
	</div>
</div>
<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>















