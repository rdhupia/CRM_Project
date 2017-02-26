<?php
include("../library/library.php");
$user = User::isUser();
$user->adminAccess();

$requests = CreditRequest::getAll(true);
$viewAll="";
if($_POST){
    if($viewAll = isset($_POST['viewAll'])){
        $requests = CreditRequest::getAll(false);
    }else if(isset($_POST['comment'])){
        $comment = $_POST['comment'];
        $empComment = $_POST['empComment'];
        $amount = $_POST['amount'];
        $isApproved = isset($_POST['approved']);
        $request = CreditRequest::withId($_POST['id']);
        $membereship = Membership::withId($_POST['membershipId']);

        $comment = $comment."<br>".$empComment;

        if($isApproved){
            //if approved
            //update request status
            $request->updateStatus("Approved",$comment,$user);

            //add credit to refrerring
            $membereship->updateBalance($amount, "+");

            //add transaction
            Transaction::addNew($user->storeCode,$user->id,"null", $amount,$membereship->id,"null","Referral Credit");

        }else{
            //if not approved
            $request->updateStatus("Declined",$comment,$user);

            // update request status
        }
        //redirect
        header("location:adminViewCreditRequests.php");
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
                    <small>Manage Credit Requests</small>
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
        <h3>No credit request record found. Click View All to view all processed requests</h3>
    </div>
<?php }else{ ?>
    <!-- /HEADER -->
    <!-- MAIN CONTENT -->
    <div class="main-content container">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Requested Date</td>
                <td>Requested By</td>
                <td>Location</td>
                <td>Membership Id</td>
                <td>Amount</td>
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
                    <td><?php print $request->membershipId;?></td>
                    <td><?php print $request->storeCode;?></td>
                    <td>$ <?php print $request->amount;?></td>
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
                                    <input type="hidden" name="membershipId" value="<?php print $request->membershipId;?>">
                                    <input type="hidden" name="amount" value="<?php print $request->amount;?>">
                                    <input type="hidden" name="empComment" value="<?php print $request->comment;?>">
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
    <!-- /MAIN CONTENT -->
<?php } ?>
<?php
Footer::write();
?>