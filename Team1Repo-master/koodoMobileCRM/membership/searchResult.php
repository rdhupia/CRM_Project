<?php
include("../library/library.php");
$user = User::isUser();

//Variable required for page operation
$message = "";
$result;
$row_cnt = 0;

if($_POST){
    $keyword = htmlentities(trim($_POST['keyword']));
    $length = strlen($keyword);
    if($length==6){
        $membershipId = $_POST['keyword'];
        if (Membership::isExist($keyword)) {
            $membership = Membership::withId($keyword);
            header("location:viewMembership.php?" . $membership->redirectString());
        }else{
            $message = "No Membership Found";
        }
    }
    // for imei, sim or phone number: find sales
    else if($length==15 || $length==19 || $length==10) {
        $result = Sale::getSalesBySearchTerm($keyword);
        $row_cnt = mysqli_num_rows($result);
    }
}
Header::write();
Menu::write("home");
?>

<header class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Search
                <small>Result</small>
            </h1>
        </div>
    </div>
</header>
<!-- MAIN CONTENT -->
<div class="main-content container">
    <div class="row text-center">
        <?php 
            if($row_cnt >= 1) {
        ?>
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
								<a class="btn btn-default " href="../salesManagementModule/viewSale.php?sId=<?php print $saleId; ?>&ksId=<?php print $koodoServiceId; ?>&uid=<?php print $userId; ?>&ret=<?php print $keyword; ?>" role="button" data-toggle="tooltip" title="Detail">View</a>
								<a class="btn btn-danger " href="../salesManagementModule/deleteSale.php?sId=<?php print $saleId; ?>&ksId=<?php print $koodoServiceId; ?>&uid=<?php print $userId; ?>&ret=<?php print "rtrn"; ?>" role="button" data-toggle="tooltip" title="Process Return">Return</a>
							</div>
						</td> 	
						   
					</tr>
				<?php 
                        }
                    }
				
				?>
				</tbody>
		      </table>
			</div> <!--- /TABLE-RESPONSIVE -->
            <?php
            } else {
                $message .= "\n <br> No Sales records found"; 
            }
            print $message;
            ?>
    </div>
</div>
<!-- /MAIN CONTENT -->

<?php
Footer::write();
?>
