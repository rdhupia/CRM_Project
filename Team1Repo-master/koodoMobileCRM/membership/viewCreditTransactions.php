<?php
	include("../library/library.php");
    $user = User::isUser();

    $membership;
    $transactions;
    if(isset($_GET['membershipId']) && isset($_GET['hash'])){
        $membershipId = $_GET['membershipId'];

        //Security Check!
        if(!Membership::isValidHash($membershipId, $_GET['hash'])){
            //if not get..
            print "Invalid access tried from viewMembership";
            exit();
        }
        $membership = Membership::withId($membershipId);
        $transactions = Transaction::withMembershipId($membershipId);
    }

    Header::write();
    Menu::write("membership");
	?>

<header class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Membership
                <small>Transaction History</small>
            </h1>
        </div>
    </div>
</header>
<div class="main-content container">
    <?php if($transactions == null){ ?>
        <h5>No Transaction Record</h5>
    <?php } else { ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Date</td>
				<td>Store</td>
				<td>Updated By</td>
				<td>Amount</td>
				<td>Transaction Type</td>
				<td>Cello ID</td>		
			</tr>
		</thead>
		<tbody>
        <?php
        foreach ($transactions as $transaction) { ?>
            <tr>
                <td><?php print substr($transaction->timestamp,0,10);?></td>
                <td><?php print $transaction->storeCode;?></td>
                <td><?php print $transaction->userId;?></td>
                <td><?php print $transaction->amount;?></td>
                <td><?php print $transaction->type;?></td>
                <td><?php print $transaction->celloNumber;?></td>
            </tr>
        <?php   }
        ?>
		</tbody>
	</table>
    <?php } ?>
    <a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
</div>
	<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>















