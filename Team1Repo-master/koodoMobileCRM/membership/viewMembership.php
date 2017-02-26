<?php
	include("../library/library.php");
    $user = User::isUser();

    $membership;
    $customer;
    $address;

    if(isset($_GET['membershipId']) && isset($_GET['hash'])){
        $membershipId = $_GET['membershipId'];

        //Security Check!
        if(!Membership::isValidHash($membershipId, $_GET['hash'])){
            //if not get..
            print "Invalid access tried from viewMembership";
            exit();
        }

        $membership = Membership::withId($membershipId);
        $customer = Customer::withId($membership->customerId);
        $address = Address::withId($customer->addressId);
    }else{
        //if not get...
        //error
        print "Invalid access tried from viewMembership";
        exit();
    }

    Header::write();
    Menu::write("membership");
	?>

<header class="container">
	<!-- Page Heading/Breadcrumbs -->
	<div class="row">
        <div class="col-lg-12">
                <h1 class="page-header">Membership
                    <small>Details</small>
                </h1>
        </div>				
    </div>
</header>

<!-- MAIN CONTENT -->
<div class="main-content container">
    <div class="row text-center">
     <div class="btn-group" role="group">
                    <a class="btn btn-default" href="updateProfile.php?<?php print $membership->redirectString();?>">Update Profile</a>
                    <?php if($membership->isVIP()){ ?>
                        <a class="btn btn-default" href="viewVIPMenu.php?<?php print $membership->redirectString();?>">VIP Menu</a>
                    <?php } else { ?>
                        <a class="btn btn-default" href="activateVIP.php?<?php print $membership->redirectString();?>">Activate VIP</a>
                    <?php } ?>
                    <a class="btn btn-default" href="requestReferral.php?<?php print $membership->redirectString();?>">Request Referral</a>
                    <?php if($membership->balance > 0){ ?>
					<a class="btn btn-default" href="redeemCredit.php?<?php print $membership->redirectString();?>">Redeem Credit</a>
                    <?php } ?>
                    <a class="btn btn-default" href="addCredit.php?<?php print $membership->redirectString();?>">Add Credit</a>
					<a class="btn btn-default" href="viewCreditTransactions.php?<?php print $membership->redirectString();?>">View Credit Transaction</a>
					<a class="btn btn-default" href="viewRequestsStatus.php?<?php print $membership->redirectString();?>">View Requests Status</a>


         </div>
        </div>
        <br>
    <div class="row">

        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                    <th colspan="2">Customer Information</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php print $customer->firstName." ".$customer->lastName;?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php print $address->street." ".$address->city." ".$address->postalCode;?></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><?php print $customer->phoneNumber;?></td>
                    </tr>
                    <tr>
                        <td>Alternate Number</td>
                        <td><?php print $customer->phoneNumber2;?></td>
                    </tr>
                    <tr>
                        <td>E-Mail</td>
                        <td><?php print $customer->email;?></td>
                    </tr>
                </tbody>
	        </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                <th colspan="2">Membership Information</th>
                </thead>
                <tbody>
                <tr>
                    <td>Membership Id</td>
                    <td><?php print $membership->id;?></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td>$ <?php print $membership->balance;?></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td><?php print substr($membership->startDate,0,10);?></td>
                </tr>
                <tr>
                    <td>Email Password</td>
                    <td><?php print $membership->emailPassword;?></td>
                </tr>
                <tr>
                    <td>VIP Status</td>
                    <td>
                        <?php print $membership->isVIP()? "YES" : "NO";?>
                        <!-- If Admin and If VIP-->
                       </td>
                </tr>
                <tr>
                    <td>VIP Start Date</td>
                    <td><?php print $membership->VIPStartDate;?></td>
                </tr>
                <?php if($user->isAdmin() && $membership->isVIP()){ ?>
                <tr>
                    <td>
                        Deactivate VIP
                    </td>
                    <td>

                            <form action="adminManageMemberships.php" method="POST">
                                <input type="submit" value="Deactivate" class="btn btn-danger btn-sm">
                                <input type="hidden" name="membershipId" value="<?php print $membership->id;?>">
                            </form>

                        <!--If Admin End-->
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
				
</div>
<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>