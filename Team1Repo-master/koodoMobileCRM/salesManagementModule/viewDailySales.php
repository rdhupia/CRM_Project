<?php
	//This is Page Template
	include("../library/library.php");
    // Get current user object
    $user = User::isUser();
    
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	$records = 0;
    
	$header->writeHeader();
	$menu->writeMenu("sale");
	
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>View Today's Sales</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
			
			<!-- TABLE-RESPONSIVE -->
			<div class="table-responsive">
			  <table class="table table-striped">
			  	<thead>
			  		<tr>
			  		<!-- KoodoServiceId -->
					<!-- get userId, koodoServieId, typeCode -->
			  			<th class="col-sm-1 col-md-1">SALES PERSON</th> <!-- found in: user: as: firstName+lastName  -->
			  			<th class="col-sm-2 col-md-2">PHONE #</th>      <!-- found in: koodoService: as: phoneNumber -->
			  			<th class="col-sm-1 col-md-1">PHONE MODEL</th>  <!-- found in: koodoService: as: modelCode   -->
			  			<th class="col-sm-2 col-md-2">IMEI</th>         <!-- found in: koodoService: as: imeiNumber  -->
			  			<th class="col-sm-2 col-md-2">SIM</th>          <!-- found in: koodoService: as: simNumber   -->
			  			<th class="col-sm-1 col-md-1">SALE TYPE</th>    <!-- found: typeCode -->
						<th class="col-sm-2 col-md-2"></th>            
			  		</tr>
			  	</thead>
				
				<tbody>
				<?php 
                
				    //runs query
				    $result = Sale::getTodaysSales();
                    if($result === false) 
                        echo "No Sale recorded for the day";
                    else {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $saleId = $row['id'];
                            if( SaleStatus::isStatusSold($saleId) )
                            {
                                $userId = $row['userId'];
                                $koodoServiceId = $row['koodoServiceId'];
                                $saleType = $row['typeCode'];
                                $koodoServiceInstance = KoodoService::withId($koodoServiceId);
                                $userInstance = User::withId($userId);
                                $records++;
				?>
                
					<tr>
                        		
						<td><?php print $userInstance->firstName." ". $userInstance->lastName; ?></td>
						<td><?php print $koodoServiceInstance->phoneNumber; ?></td>
						<td><?php print $koodoServiceInstance->modelCode; ?></td>
						<td><?php print $koodoServiceInstance->imeiNumber; ?></td>
						<td><?php print $koodoServiceInstance->simNumber; ?></td>
						<td><?php print $saleType; ?></td>
						<?php $strReceipt = $saleType."\t".$koodoServiceInstance->phoneNumber."\t".
                              $koodoServiceInstance->imeiNumber."\t".$koodoServiceInstance->simNumber."\t".
                              $koodoServiceInstance->modelCode."\t".$koodoServiceInstance->tab; ?>
						
						<td>
							<div class="btn-group" role="group" aria-label="...">
								<a class="btn btn-default " href="viewSale.php?sId=<?php print $saleId; ?>&ksId=<?php print $koodoServiceId; ?>&uid=<?php print $userId; ?>" role="button" data-toggle="tooltip" title="Detail"><span class="glyphicon glyphicon-zoom-in"></span> </a>
								<a class="btn btn-default " href="updateSale.php?sId=<?php print $saleId; ?>&ksId=<?php print $koodoServiceId; ?>&uid=<?php print $userId; ?>" role="button" data-toggle="tooltip" title="Update"><span class="glyphicon glyphicon-pencil"></span> </a>
								
									<!-- Button trigger modal -->
									
										<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
										  <span data-toggle="tooltip" title="Get Receipt" class="glyphicon glyphicon-download-alt"></span> 
										</button>

										<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">Receipt #</h4>
											  </div>
											  <div class="modal-body">
												<?php print $strReceipt; ?> 
											  </div>
											  <div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											  </div>
											</div>
										  </div>
										</div><!-- /Modal -->
										
								<a class="btn btn-danger " href="deleteSale.php?sId=<?php print $saleId; ?>&ksId=<?php print $koodoServiceId; ?>&uid=<?php print $userId; ?>" role="button" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span> </a>
							</div>
						</td> 	
						   
					</tr>
				<?php 
                        }
                    }
				}
                // if($records === 0) echo "No Sale Records to Show for Today.";
				?>
				</tbody>
		      </table>
			</div> <!--- /TABLE-RESPONSIVE -->
		</div>
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>