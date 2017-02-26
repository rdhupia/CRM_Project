<?php
	//This is Page Template
	include("../library/library.php");
     // Get current user object
    $user = User::isUser();
    $user->adminAccess();
    
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	$header->writeHeader();
	$menu->writeMenu("admin");
    
    $month=date("F");
    $year=date("Y");
    
    if($_GET) {
        if(isset($_GET['month']))
            $month = $_GET['month'];
        if(isset($_GET['year']))
            $year = $_GET['year'];
    }
    
    if($_POST) {
            
            $userId = htmlentities(trim($_POST['uid']));
            $salesTarget = htmlentities(trim($_POST['salesTarget']));
            $accTarget = htmlentities(trim($_POST['accTarget']));
                        
        if(isset($_POST['update'])) {
            // If target exists, update targets
            if( SalesTargets::isTargetSet($month, $year, $userId) )
                SalesTargets::updateSalesTargets($month, $year, $userId, $salesTarget, $accTarget);
            // else add new targets
            else 
                SalesTargets::addNew($month, $year, $userId, $salesTarget, $accTarget);            
        }
        if(isset($_POST['reset'])) {
           // If target exists, update targets
            if( SalesTargets::isTargetSet($month, $year, $userId) )
                SalesTargets::reset($month, $year, $userId);     
        }
        
    }
    
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Sales Targets</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container ">
			
            <!-- Select Month and Year -->
			<form class="form-horizontal" action = "<?php $_PHP_SELF ?>" method="GET">
                <div class="form-group">
                    <div class="col-sm-2">
                        <select class="form-control" name="month" id="month">
                            <option <?php if($month ===  "January") echo "selected";?> value="January">January</option>
                            <option <?php if($month ===  "February") echo "selected";?> value="February">February</option>
                            <option <?php if($month ===  "March") echo "selected";?> value="March">March</option>
                            <option <?php if($month ===  "April") echo "selected";?> value="April">April</option>
                            <option <?php if($month ===  "May") echo "selected";?> value="May">May</option>
                            <option <?php if($month ===  "June") echo "selected";?> value="June">June</option>
                            <option <?php if($month ===  "July") echo "selected";?> value="July">July</option>
                            <option <?php if($month ===  "August") echo "selected";?> value="August">August</option>
                            <option <?php if($month ===  "September") echo "selected";?> value="September">September</option>
                            <option <?php if($month ===  "October") echo "selected";?> value="October">October</option>
                            <option <?php if($month ===  "November") echo "selected";?> value="November">November</option>
                            <option <?php if($month ===  "December") echo "selected";?> value="December">December</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="year" id="year">
                            <option value="<?php print $year; ?>" selected><?php print $year; ?></option>
                            <option value="<?php print ($year+1); ?>"><?php print ($year+1); ?></option>
                            <option value="<?php print ($year+2); ?>"><?php print ($year+2); ?></option>
                            <option value="<?php print ($year+3); ?>"><?php print ($year+3); ?></option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-primary btn-md" type="submit"> Change </button>
                    </div>
                </div>
			</form>	
            			
			<!-- TABLE-RESPONSIVE -->
			<div class="main-content container">
                <div class="row">
				    <h4>Set Sales Targets for <?php print $month." ".$year;?></h4>
			    </div>
			  <table class="table table-striped">
                
                    <thead>
                        <tr>
                            <th class="col-md-1">S.No</th>
                            <th class="col-md-2">Employee Name</th>
                            <th class="col-md-2">Username</th>
                            <th class="col-md-2">Sales Target</th>
                            <th class="col-md-2">Accessory Target</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                         
                        <?php 
                            $result = User::getAllUsers();
                            while( $row = mysqli_fetch_assoc($result) ) 
                            {
                                $targetsResult = SalesTargets::getSetTargets($month, $year, $row['id']);
                                $targetsRow = mysqli_fetch_assoc($targetsResult);
                        ?>
                        <form class="form-horizontal" action = "<?php $_PHP_SELF ?>" method="POST">      
                            <tr>
                                <td><input type="text" class="form-control" id="empNum" name="uid" value="<?php print $row['id']; ?>" readonly></td>
                                <td><input type="text" class="form-control" id="empName" name="empName" value="<?php print $row['firstName']." ".$row['lastName']; ?>" readonly></td>
                                <td><input type="text" class="form-control" id="userName" name="userName" value="<?php print $row['userName']; ?>" readonly></td>
                                <td><input class="form-control" type="number" name="salesTarget" value="<?php print $targetsRow['salesTarget'];?>" /></td>
                                <td><input class="form-control" type="number" name="accTarget" value="<?php print $targetsRow['accTarget'];?>" /></td>
                                <td> 
                                    <button class="btn btn-success btn-sm" type="submit" name="update"> Update </button>
                                    <button class="btn btn-danger btn-sm" type="submit" name="reset"> Reset </button>
                                </td>
                            </tr>
                        </form>
                        <?php
                            }
                        ?>
                    </tbody>
		      </table>
			</div> <!--- /TABLE-RESPONSIVE -->
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>

