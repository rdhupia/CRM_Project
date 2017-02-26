<?php
	include("../library/library.php");
    $user = User::isUser();

    if(isset($_GET['membershipId']) && isset($_GET['hash'])){
        $membershipId = $_GET['membershipId'];

        //Security Check!
        if(!Membership::isValidHash($membershipId, $_GET['hash'])){
            //if not get..
            print "Invalid access tried from viewMembership";
            exit();
        }
        $membership = Membership::withId($membershipId);
        $transactions = Transaction::VIPwithMembershipId($membershipId);
    }

    if($_POST){
        $userName = $_POST['userName'];
        $amount = $_POST['amount'];
        $celloNumber = $_POST['celloNumber'];
        $password = $_POST['password'];
        $serviceId = $_POST['serviceId'];

        //Check user name
        //Check User Password
        if($user->checkPassword($password)){
            //If passed

            //Add Transaction
            Transaction::addNew($user->storeCode, $user->id, $serviceId, $amount, $membership->id, $celloNumber, VIPService::serviceWithId($serviceId));

            //Redriect to view membership
            unset($_SESSION['incorrectPassword']);
            header("location:viewVIPMenu.php?".$membership->redirectString());
        }else{

            if($_SESSION['incorrectPassword'] == 1){
                header("location:../employeeManagementModule/logout.php");
            }else {
                $errMsg = "<h3>Incorrect User Password. If incorrect password entered once more, the current user will be logged out.</h3>";
                $_SESSION['incorrectPassword'] = 1;
            }
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
                    <small>VIP Menu</small>
                </h1>

            </div>
        </div>
<!-- MAIN CONTENT -->
<div class="main-content container-fluid">
	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label class="control-label  col-md-4">Membership Id</label>
			<div class="col-md-4">
				<input class="form-control" name="membershipId"  maxlength="6" readonly value="<?php print $membershipId;?>">
			</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-4">Service</label>
		<div class="col-md-4">
			<select name = "serviceId" class="form-control" required>
						<option value="">--Select Service--</option>
                <?php $services = VIPService::getAll();
                foreach ($services as $service){
                    if($service->id != 99) {?>
                    <option value="<?php print $service->id;?>"><?php print $service->title;?></option>
             <?php   }}
                    ?>



					</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label  col-md-4">Amount</label>
			<div class="col-md-4">
				<input type="numbers"  step="0.01" required min="0.01" required min="0" name="amount" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label  col-md-4">Cello Transaction Number</label>
			<div class="col-md-4">
				<input class="form-control"  placeholder="Cello Transaction Number" maxlength="13" name="celloNumber" pattern="[\d]{13}" title="Cello T.N. must be 13 numeric digits only.">
			</div>
		</div>			
		<div class="form-group">
			<label class="control-label  col-md-4">Username</label>
			<div class="col-md-4">
				<input class="form-control" readonly name="userName"   maxlength="5" value="<?php print $user->userName;?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label  col-md-4">Password</label>
			<div class="col-md-4">
				<input class="form-control" placeholder="Password" id="password" name="password"   type="password"  maxlength="5" required pattern="[a-zA-Z0-9]{3,5}" title="3 to 5 alpha, numeric digits only">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4"></label>
			<div class="col-md-4">
				<input class="form-control" type="submit" value="Submit">
			</div>
		</div>
	</form>

    <div class="row">
        <a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
    </div>
	<div class="row">
		<div class=" text-center col-md-4 col-md-offset-4">
			<span class="bg-danger"></span>
		</div>
	</div>	
	<div class="row">
		<h3>VIP Trasaction History</h3>
		<hr/>
	</div>				
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Date & Time</th>
				<th>Location</th>
				<th>User Name</th>
				<th>Service</th>
				<th>Amount</th>
				<th>Cello ID</th>
			</tr>
		</thead>
		<tbody>
        <?php
        foreach ($transactions as $transaction){
           ?>
            <tr>
                <td><?php print substr($transaction->timestamp,0,10);?></td>
                <td><?php print $transaction->storeCode;?></td>
                <td><?php print User::getUserNameWihtId($transaction->userId);?></td>
                <td><?php print $transaction->type;?></td>
                <td>$ <?php print $transaction->amount;?></td>
                <td><?php print $transaction->celloNumber;?></td>
            </tr>
           <?php   }
        ?>


		</tbody>
	</table>
</div>
    </div>
<!-- /MAIN CONTENT -->


<?php
    Footer::write();
?>