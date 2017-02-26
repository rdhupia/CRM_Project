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
    
    // Default start and end dates. One week from current date.
    $from_date = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 week')); 
    $to_date = date('Y-m-d');
    $store = "A";
        
    if($_GET)    {
        if(isset($_GET['startDate'])) {
            $from_date = $_GET['startDate'];
        }
        if(isset($_GET['endDate'])) {
            $to_date = $_GET['endDate'];
        }
        if(isset($_GET['store'])) {
            $store = $_GET['store'];
        }
        if(isset($_GET['viewAllSubmit'])) {
            $from_date = NULL;
            $to_date = NULL;
            $store = "A";
        }
    }
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>View Sales</h2>
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
					<label for="storeLocation">Select Store</label>
					<select class="form-control" name="store" id="storeLocation">
						<option <?php if($store ===  "A") echo "selected";?> value="A">All Stores</option>
						<option <?php if($store ===  "S") echo "selected";?> value="S">Sheridan</option>
						<option <?php if($store ===  "Y") echo "selected";?> value="Y">Yonge</option>
						<option <?php if($store ===  "W") echo "selected";?> value="W">Woodside</option>
						<option <?php if($store ===  "T") echo "selected";?> value="T">Trethewey</option>
					</select>
				</div>	
				<div class="form-group">
				<button type="submit" class="btn btn-primary" name="searchSubmit">Search</button>
				<button type="submit" class="btn btn-success" name="viewAllSubmit">View All</button>
				</div>
			</form>
			<h3>Sales List</h3>
			<!-- TABLE-RESPONSIVE -->
			<div class="table-responsive">
			  <table class="table table-striped">
			  	<thead>
			  		<tr>
			  			<th class="col-sm-1 col-md-1">SALE ID</th>
                        <th class="col-sm-1 col-md-1">DATE</th>
                        <th class="col-sm-1 col-md-1">STORE</th>
			  			<th class="col-sm-1 col-md-1">SALES PERSON</th>
			  			<th class="col-sm-2 col-md-2">PHONE#</th>
			  			<th class="col-sm-1 col-md-1">PHONE MODEL</th>
			  			<th class="col-sm-2 col-md-2">IMEI#</th>
			  			<th class="col-sm-2 col-md-2">SIM#</th>
			  			<th class="col-sm-1 col-md-1">SALE TYPE</th>
			  		</tr>
			  	</thead>
				
				<tbody>
				<?php
                    // runs query
                    $result = Sale::getSales($from_date, $to_date, $store);
                    if($result === false)
                        print "No sale recorded during the period";
                    else {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $saleId = $row['id'];
                            if( SaleStatus::isStatusSold($saleId) )
                            {
                                $userId = $row['userId'];
                                $storeCode = $row['storeCode'];
                                $koodoServiceId = $row['koodoServiceId'];
                                $saleType = $row['typeCode'];
                                $dateOfSale = $row['dateOfSale'];
                                $koodoServiceInstance = KoodoService::withId($koodoServiceId);
                                $userInstance = User::withId($userId);
					?>
					<tr>
						<td><?php print $saleId; ?></td>
                        <td><?php print date("d/m/Y", strtotime($dateOfSale)); ?></td>
                        <td><?php print $storeCode; ?></td>
						<td><?php print $userInstance->firstName." ". $userInstance->lastName; ?></td>
						<td><?php print $koodoServiceInstance->phoneNumber; ?></td>
						<td><?php print $koodoServiceInstance->modelCode; ?></td>
						<td><?php print $koodoServiceInstance->imeiNumber; ?></td>
						<td><?php print $koodoServiceInstance->simNumber; ?></td>
						<td><?php print $saleType; ?></td>	   
					</tr>
				<?php 
                            }
                        }
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