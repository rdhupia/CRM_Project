<?php
	include("../library/library.php");
    $user = User::isUser();
    $user->adminAccess();

    //Check Admin
    $memberships = Membership::getAll();
    $date = Date('Y-m-d');

    if($_POST){
        if(isset($_POST['membershipId'])){
            $membershipId = $_POST['membershipId'];
            $membership = Membership::withId($membershipId);
            $membership->deactivateVIP();
            header("location:".$_SERVER['PHP_SELF']);
        }

        if(isset($_POST['date'])){
            $memberships = Membership::getAllWith($_POST['date']);
            $date = $_POST['date'];
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
                    <small>Manage VIP Memberships</small>
                </h1>
            </div>
        </div>
    </header>

<!-- /HEADER -->
<!-- MAIN CONTENT -->
    <div class="main-content container">
        <div class="row">
            <form method="post">
            <div class="input-group searchBar col-md-4 col-md-offset-4">

                <input type="date" name="date" class="form-control" value="<?php print $date;?>">
                  <span class="input-group-btn">
                    <input type="submit"  name="firstProcess" value="search" class="btn btn-default form-control" >
                  </span>

            </div>
            </form>
        </div>
        <br>
        <?php if($memberships == null){?>
            <h4>No Record Found</h4>
        <?php               }else{?>
	<table class="table table-striped">
		<thead>
			<tr >
				<th>Member ID</th>
				<th>VIP Start date</th>
				<th>Register date</th>
				<th>balance</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>

             <?php   foreach ($memberships as $membership) { ?>
            <tr>
                <td><?php print $membership->id;?></td>
                <td><?php print substr($membership->VIPStartDate,0,10);?></td>
                <td><?php print substr($membership->startDate,0,10);?></td>
                <td><?php print $membership->balance;?></td>
                <td>
                    <form action="adminManageMemberships.php" method="POST">
                        <input type="submit" value="Deactivate VIP" class="form-control btn btn-danger">
                        <input type="hidden" name="membershipId" value="<?php print $membership->id;?>">
                    </form>
                </td>
            </tr>
            <?php   }}
            ?>
			</tr>					
		</tbody>
	</table>
</div>
	<!-- /MAIN CONTENT -->

<?php
	Footer::write();
?>