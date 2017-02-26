    <?php
	include("../library/library.php");
    $user = User::isUser();
    $membership;
    $membershipId;
    if(isset($_GET['membershipId']) && isset($_GET['hash'])){
        $membershipId = $_GET['membershipId'];

        //Security Check!
        if(!Membership::isValidHash($membershipId, $_GET['hash'])){
            //if not get..
            print "Invalid access tried from ddd";
            exit();
        }
        $membership = Membership::withId($membershipId);
    }

    if($_POST){
        $amount = $_POST['amount'];
        $comment = $_POST['comment'];

        CreditRequest::addNew($membershipId, $amount, $user, $comment);

        header("location:viewMembership.php?".$membership->redirectString());
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
                <small>Redeem Credit</small>
            </h1>
        </div>
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
			<label class="control-label  col-md-4">Amount</label>
				<div class="col-md-4">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="number" required min="1" name="amount" class="form-control">
					</div>
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
                <input type="submit" value="Request" class="btn btn-primary form-control">
			</div>
		</div>
	</form>		
</div>
<!-- /MAIN CONTENT -->

<?php
Footer::write();
?>















