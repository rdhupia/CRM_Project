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
    
    $currentStore = $user->storeCode;                    // GET STORE LOCATION FROM SESSION*****
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Sales Summary</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
			<div class="table">
			  <table class="table table-striped">
			  	<thead>
			  		<tr>
			  			<th class="col-sm-1 col-md-1"></th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "S") print "success"?>">SHERIDAN</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "W") print "success"?>">WOODSIDE</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "Y") print "success"?>">YONGE</th>
			  			<th class="col-sm-1 col-md-1  <?php if($currentStore === "T") print "success"?>">TRETHEWEY</th>
			  		</tr>
			  	</thead>
				
				<tbody>
                    <?php
                        $result = Type::getAllCodesDescriptions(NULL);
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
					<tr>
						<td><?php print $row['description'];?></td>
						<td <?php if($currentStore === "S") print 'class="success"'?>><?php print Sale::getSaleTypeCount($row['code'], "S" );?></td>
						<td <?php if($currentStore === "W") print 'class="success"'?>><?php print Sale::getSaleTypeCount($row['code'], "W" );?></td>
						<td <?php if($currentStore === "Y") print 'class="success"'?>><?php print Sale::getSaleTypeCount($row['code'], "Y" );?></td>
						<td <?php if($currentStore === "T") print 'class="success"'?>><?php print Sale::getSaleTypeCount($row['code'], "T" );?></td>
					</tr>
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