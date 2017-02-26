<?php
	include("../library/library.php");
    $user = User::isUser();

    $membership;
    $customer;
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
        $customer = Customer::withId($membership->customerId);
    }else{
        //if not get...
        //error
        print "Invalid access tried from viewMembership";
        exit();
    }

    if($_POST) {

        $password = $_POST['password'];
        $celloNumber = $_POST['celloNumber'];

        //Check User Password
        if($user->checkPassword($password)){
            //If passed

            //Activate VIP
            $membership->activateVIP();

            //Add Transaction
            Transaction::addNew($user->storeCode, $user->id, 99, 0, $membershipId, $celloNumber, "VIP Activation");
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
<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Membership
                <small>Activate VIP</small>
            </h1>

        </div>
    </div>
    <!-- MAIN CONTENT -->
    <div class="main-content container-fluid">
<div class="main-content container-fluid">
    <?php print $errMsg; ?>
	<form class="form-horizontal" method="POST">
		<div class="form-group">
			<label class="control-label  col-md-4">Membership Id</label>
			<div class="col-md-4">
				<input class="form-control" name="membershipId"  maxlength="6" readonly value="<?php print $membership->id;?>">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Name</label>
			<div class="col-md-4">
				<input class="form-control" value="<?php print $customer->firstName." ".$customer->lastName;?>" readonly>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Phone Number</label>
			<div class="col-md-4">
				<input class="form-control"  readonly value="<?php print $customer->phoneNumber;?>">
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label  col-md-4">Cello Transaction Number</label>
			<div class="col-md-4">
				<input class="form-control" required placeholder="Cello Transaction Number" maxlength="13" name="celloNumber" pattern="[\d]{13}" title="Cello T.N. must be 13 numeric digits only.">
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
				<input class="form-control" required placeholder="Password" id="password" name="password"   type="password"  maxlength="5" required pattern="[a-zA-Z0-9]{3,5}" title="3 to 5 alpha, numeric digits only">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4"></label>
			<div class="col-md-4">
                <input type="submit" class="btn btn-primary form-control" value="Activate VIP">
			</div>
		</div>
	</form>
    <div class="row">
        <a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
    </div>
	<div class="row">
		<div class="text-center col-md-4 col-md-offset-4">
			<span class="bg-danger"></span>
		        </div>
	        </div>
        </div>
    </div>
</div>
<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>

