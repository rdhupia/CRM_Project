<?php
	//This is Page Template
	include("../library/library.php");
    // Get current user object
    $user = User::isUser();
    $user->adminAccess();
    $currentStore = $user->storeCode;
    
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	$header->writeHeader();
	$menu->writeMenu("admin");
    $status = "sold";
    
    // Default start and end dates. One week from current date.
    $from_date = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 week')); 
    $to_date = date('Y-m-d');
            
    if($_GET)    {
        if(isset($_GET['startDate'])) {
            $from_date = $_GET['startDate'];
        }
        if(isset($_GET['endDate'])) {
            $to_date = $_GET['endDate'];
        }
        if(isset($_GET['status'])) {
            $status = $_GET['status'];
        }
        if(isset($_GET['viewAllSubmit'])) {
            $from_date = NULL;
            $to_date = NULL;
            $status = "sold";
        }
    }
    
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Model Trend</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
			
			<form class="form-inline" action = "<?php $_PHP_SELF ?>" method="GET">
                <!-- Start date week before today and end date current date by default -->
				<div class="form-group">
					<label for="start-date">Start Date</label>         
						<input id="start-date" type="date" name="startDate" value="<?php print $from_date; ?>">
					<label for="end-date">End Date</label>
						<input id="end-date" type="date" name="endDate" value="<?php print $to_date; ?>">
				</div>
                <div class="form-group">
					<label for="salesStatuses">Select Sales</label>
					<select class="form-control" name="status" id="salesStatuses">
						<option <?php if($status ===  "sold") echo "selected";?> value="sold">All Sales "Sold"</option>
						<option <?php if($status ===  "returned") echo "selected";?> value="returned">Sales "Returned"</option>
						<option <?php if($status ===  "deleted") echo "selected";?> value="deleted">Sales "Deleted"</option>
					</select>
				</div>	
				<div class="form-group">
				<button type="submit" class="btn btn-primary" name="searchSubmit">Search</button>
				<button type="submit" class="btn btn-success" name="viewAllSubmit">View All</button>
				</div>
			</form>
            
		<h3>Models List</h3>
		<!-- TABLE RESPONSIVE -->		
		<div class="main-content container">
			<div class="table">
			  <table class="table table-striped">
			  	<thead>
			  		<tr>
			  			<th class="col-sm-1 col-md-1">Models</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "S") print "success"?>">SHERIDAN</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "W") print "success"?>">WOODSIDE</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "Y") print "success"?>">YONGE</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "T") print "success"?>">TRETHEWEY</th>
                        <th class="col-sm-1 col-md-1">Sum</th>
			  		</tr>
			  	</thead>
				
				<tbody>
                    <?php
                        $result = Model::getAllCodes();
                        $countS = Sale::getModelCount($from_date, $to_date, "S", $status, $result);
                        mysqli_data_seek($result, 0);
                        $countW = Sale::getModelCount($from_date, $to_date, "W", $status, $result);
                        mysqli_data_seek($result, 0);
                        $countY = Sale::getModelCount($from_date, $to_date, "Y", $status, $result);
                        mysqli_data_seek($result, 0);
                        $countT = Sale::getModelCount($from_date, $to_date, "T", $status, $result);
                        $counter = 0;
                        mysqli_data_seek($result, 0);
						while($row = mysqli_fetch_assoc($result)) {
                            ?>
					<tr>
						<td><?php print $row['code'];?></td>
						<td <?php if($currentStore === "S") print 'class="success"'?>><?php print $countS[$counter];?></td>
						<td <?php if($currentStore === "W") print 'class="success"'?>><?php print $countW[$counter];?></td>
						<td <?php if($currentStore === "Y") print 'class="success"'?>><?php print $countY[$counter];?></td>
						<td <?php if($currentStore === "T") print 'class="success"'?>><?php print $countT[$counter];?></td>
                        <td ><?php $total = $countS[$counter]+$countW[$counter]+$countY[$counter]+$countT[$counter]; print $total; ?></td>
					</tr>
                    <?php
                            $counter++;
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

