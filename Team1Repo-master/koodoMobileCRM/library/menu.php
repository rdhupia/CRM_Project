<?php
	
class Menu
{
	public static function write($active){
		$instance = new self();
		$instance->writeMenu($active);
	}
	
	public function writeMenu( $active )
	{
		$home = "";
		$sale = "";
		$customer = "";
		$membership = "";
		$operations = "";
		$admin = "";
		
		if(strcmp($active, "home") == 0)
			$home = "class=\"active\"";
		if(strcmp($active, "sale") == 0)
			$sale = "active";
		if(strcmp($active, "customer") == 0)
			$customer = "active";
		if(strcmp($active, "membership") == 0)
			$membership = "active";
		if(strcmp($active, "operations") == 0)
			$operations = "active";
		if(strcmp($active, "admin") == 0)
			$admin = "active";
		?>
			
			<body>
		
				<!-- NAVIGATION BAR -->
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="../employeeManagementModule/home.php"> <img src="../img/logo_transparent.png" alt="WorldComm logo" class="WorldComm logo"> </a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li <?php echo $home ?>><a href="../employeeManagementModule/home.php">HOME <span class="sr-only">(current)</span></a></li>
								<li class="dropdown <?php echo $sale ?>">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">SALES <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li ><a href="../salesManagementModule/addSale.php">Add New Sale</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../salesManagementModule/viewDailySales.php">View Daily Sales</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../salesManagementModule/salesSummary.php">Sales Summary</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../salesManagementModule/dailyInventory.php">Daily Inventory</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../salesManagementModule/viewSalesTarget.php">Sales Targets</a></li>
										<li role="separator" class="divider"></li>
									</ul>
								</li>
								
								<li class="dropdown <?php echo $membership ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">MEMBERSHIP <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="../membership/addMembershipInit.php">Add Membership</a></li>
										<li role="separator" class="divider"></li>
										<li role="separator" class="divider"></li>
										<li><a href="../membership/checkBalance.php" target="_blacnk">Check Balance</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../membership/viewMembershipPolicy.php">Membership Info</a></li>
																	
										
									</ul>
								</li>
                                <?php
                                    //menu must be called after session_start()... 
                                    $user = USER::getCurrentUser();
                                    if($user->isAdmin()){ ?>
								<!-- Admin Menu-->
								<li class="dropdown <?php echo $admin ?>"><a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMIN <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Membership</a>
											<ul class="dropdown-menu">
												<li class="dropdown-header">Membership</li>
												<li><a href="../membership/adminManageMemberships.php">Manage Members</a></li>
												<li role="separator" class="divider"></li>
												<li><a href="../membership/adminViewCreditRequests.php">Credit Request</a></li>
												<li role="separator" class="divider"></li>
												<li><a href="../membership/adminViewReferralRequests.php">Referral Request</a></li>
												<li role="separator" class="divider"></li>
											</ul>
										</li>
										<li role="separator" class="divider"></li>
										
										<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Employees </a>
											<ul class="dropdown-menu">
												<li class="dropdown-header">Employee Accounts</li>
												<li><a href="../employeeManagementModule/UserManager.php">Manage Users</a></li>
												<li role="separator" class="divider"></li>					
												<!--<li><a href="#">Manage 'Strikes'</a></li>
												<li role="separator" class="divider"></li>-->
											</ul>
										</li>
										<li role="separator" class="divider"></li>
										
										<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Sales </span></a>
											<ul class="dropdown-menu">								
												<li class="dropdown-header">Sales</li>
												
												<li><a href="../salesManagementModule/viewSalesAdmin.php">View Sales</a></li>
												<li role="separator" class="divider"></li>			
												<li><a href="../salesManagementModule/ViewModelTrend.php">View Model Trends</a></li>
												<li role="separator" class="divider"></li>
												<li><a href="../salesManagementModule/ManageSalesTarget.php">Manage Sales Targets</a></li>
												<li role="separator" class="divider"></li>			
												<li><a href="../salesManagementModule/adminViewSalesProgress.php">Sales Progress</a></li>
												<li role="separator" class="divider"></li>
											</ul>
										</li>
										<li role="separator" class="divider"></li>		
									</ul>
								</li>
                                    <!-- Admin Menu End-->
                                <?php } ?>
							</ul>

							<!-- Search Bar -->
							<div class="col-xs-5 col-sm-3 pull-left">
                                <form method="POST" action="../membership/searchResult.php">
                                        <div class="input-group searchBar">
                                            <!-- Modified below for validation with phone number, imei, sim etc...-->
                                            <input type="text" maxlength="19" name="keyword" class="form-control" placeholder="Mem#, Phone#, IMEI,or SIM" required pattern="[\d]{6}|[\d]{10}|[\d]{15}|[\d]{19}" title="Should be a valid Membership, Phone, SIM, or IMEI number.">
								  <span class="input-group-btn">
									<input type="submit"  name="firstProcess" value="search" class="btn btn-default form-control">

								  </span>

                                        </div>

                                </form>
							</div>

							<!-- User Details, Log Out -->		      
							<ul class="nav navbar-nav navbar-right logOut">
								<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['current_user']->getFirstName()." ".$_SESSION['current_user']->getLastName();?> <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="../employeeManagementModule/myInfo.php">My Information</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../employeeManagementModule/updatePassword.php">Update Password</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../employeeManagementModule/ViewStrikes.php">View Strikes</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="../employeeManagementModule/logout.php">Log Out</a></li>
										<li role="separator" class="divider"></li>
									</ul>
								</li>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container -->
				</nav>
				<!-- /NAVIGATION BAR -->			
					
		<?php
	}
}
?>