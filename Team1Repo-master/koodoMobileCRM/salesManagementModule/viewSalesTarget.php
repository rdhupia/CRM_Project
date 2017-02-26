<?php
	//This is Page Template
	include("../library/library.php");
     // Get current user object
    $user = User::isUser();
    
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	$header->writeHeader();
	$menu->writeMenu("sale");
    
    // Current month and year
    $month=date("F");
    $year=date("Y");
    
    if($_GET) {
        if(isset($_GET['month']))
            $month = $_GET['month'];
        if(isset($_GET['year']))
            $year = $_GET['year'];
    }
    
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Sales Progress</h2>
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
				    <h4>Sales Progress for <?php print $month." ".$year;?></h4>
			    </div>
			  <table class="table table-striped">
                
                    <thead>
                        <tr>
                            <th class="col-md-1">S.No</th>
                            <th class="col-md-2">Employee Name</th>
                            <th class="col-md-2">Username</th>
                            <th class="col-md-1">Sales Target</th>
                            <th class="col-md-1 success">Sales Made</th>
                            <th class="col-md-1 success">Progress %</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                         
                        <?php 
                                $targetsResult = SalesTargets::getSetTargets($month, $year, $user->id);
                                $targetsRow = mysqli_fetch_assoc($targetsResult);
                                $userSales = Sale::getSalesByUser($user->id, $month, $year);
                                
                                $target = 0;
                                $target = $targetsRow['salesTarget'];
								if($target > 0) {
									$progress = ($userSales / $target)*100;
									$progress = number_format($progress, 2);
								}
								else {
									$progress = 0;
								}
                        ?>
                        <form class="form-horizontal" action = "<?php $_PHP_SELF ?>" method="POST">      
                            <tr>
                                <td class="col-md-1"><?php print $user->id; ?></td>
                                <td class="col-md-2"><?php print $user->firstName." ".$user->lastName; ?></td>
                                <td class="col-md-2"><?php print $user->userName; ?></td>
                                <td class="col-md-1"><?php print $target; ?></td>
                                <td class="col-md-1 success"><?php print $userSales;?></td>
                                <td class="col-md-1 success"><?php print $progress;?></td>
                            </tr>
                        </form>
                        
                    </tbody>
		      </table>
			</div> <!--- /TABLE-RESPONSIVE -->
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>