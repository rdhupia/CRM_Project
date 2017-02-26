<?php
	include("../library/library.php");
    $user = User::isUser();
    $errMsg = "";
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

    if($_POST){
        $userName = $_POST['userName'];
        $amount = $_POST['amount'];
        $celloNumber = $_POST['celloNumber'];
        $password = $_POST['password'];

        //Check user name
        //Check User Password
        if($user->checkPassword($password)){
            //If passed

            //Activate VIP
            $membership->updateBalance($amount,"-");

            //Add Transaction
            Transaction::addNew($user->storeCode, $user->id, "null", -$amount, $membership->id, $celloNumber, "Credit Redemption");

            //Redriect to view membership
            unset($_SESSION['incorrectPassword']);
            header("location:viewMembership.php?".$membership->redirectString());
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
<div class="main-content container">
    <?php print $errMsg; ?>
	<form class="form-horizontal" method="post">
		<div class="form-group">
			<label class="control-label  col-md-4">Membership Id</label>
			<div class="col-md-4">
				<input class="form-control" readonly value="<?php print $membership->id;?>">
			</div>
		</div>	
		
		<div class="form-group">
			<label class="control-label  col-md-4">Balance</label>
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input class="form-control"  readonly  value="<?php print $membership->balance;?>">
				</div>
			</div>
		</div>	

		<div class="form-group">
			<label class="control-label  col-md-4">Amount</label>
				<div class="col-md-4">
					<div class="input-group">
						<div class="input-group-addon">$</div>
						<input type="number" step="0.01" required min="0.01" max="<?php print $membership->balance;?>"  name="amount" class="form-control">
					</div>
				</div>
			</div>	
				
		<div class="form-group">
			<label class="control-label  col-md-4">Cello Transaction Number</label>
			<div class="col-md-4">
				<input class="form-control" required  id="celloId" placeholder="Cello Transaction Number" maxlength="13" name="celloNumber" pattern="[\d]{13}" title="Cello T.N. must be 13 numeric digits only.">
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
				<input type="submit" value="Redeem" class="btn btn-primary form-control">
			</div>

		</div>

	</form>
    <div class="row">
        <a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
    </div>
</div>
<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>















