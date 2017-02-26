<?php
	include("../library/library.php");
	session_start();

	if (!isset($_SESSION['current_user'])){
      header("location:login.php");
      exit();
	}

	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	$dblink = new DBLink();

	$user=$_SESSION['current_user'];
	
	$header->writeHeader();
	$menu->writeMenu("home");
	
	
	$firstName=$_SESSION['current_user']->getFirstName();
	$lastName=$_SESSION['current_user']->getLastName();
?>
<header class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">HOME
            </h1>
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->

<!-- MAIN CONTENT -->
<div class="main-content container-fluid">
	<div class="row">
        <div class="col-md-12 text-center">
		<h4>Welcome, <?php echo $firstName." ".$lastName?>!</h4>
    </div>
	<div class="row">
		<div class="col-md-12 text-center">
			<a href="myInfo.php"><button class="btn btn-primary btn-lg" style="height:100px;"><span class="glyphicon glyphicon-cog"></span><br>Account</button></a>
            <a href="../salesManagementModule/viewDailySales.php"><button class="btn btn-success btn-lg" style="height:100px;"><span class="glyphicon glyphicon-search"></span><br>View Sales</button></a>
            <a href="../salesManagementModule/dailyInventory.php"><button class="btn btn-danger btn-lg" style="height:100px;"><span class="glyphicon glyphicon-envelope"></span><br>Send Report</button></a>
			<a href="../salesManagementModule/addSale.php"><button class="btn btn-warning btn-lg" style="height:100px;"><span class="glyphicon glyphicon-plus"></span><br>Add Sales</button></a>
            <a href="../membership/addMembershipInit.php"><button class="btn btn-info btn-lg" style="height:100px;"><span class="glyphicon glyphicon-user"></span><br>Add Member</button></a>

		</div>
	</div>
	<br>
	<div class="row">
		<h3>Modules</h3>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h4>Membership Module</h4>

<p><strong>Actor: Employee</strong> </p>

<ul>
<li>Add Membership <span class="glyphicon glyphicon-ok"></span></li>
<li>Update Membership Profile <span class="glyphicon glyphicon-ok"></span></li>
<li>View Membership Detail <span class="glyphicon glyphicon-ok"></span></li>
<li>Activate VIP <span class="glyphicon glyphicon-ok"></span></li>
<li>Redeem Credit <span class="glyphicon glyphicon-ok"></span></li>
<li>Add Credit <span class="glyphicon glyphicon-ok"></span></li>
<li>Redeem VIP Privileges <span class="glyphicon glyphicon-ok"></span></li>
<li>View Credit Transaction <span class="glyphicon glyphicon-ok"></span></li>
<li>View Requests Status <span class="glyphicon glyphicon-ok"></span></li>
<li>Search Membership with ID <span class="glyphicon glyphicon-ok"></span></li>
</ul>

<p><strong>Actor: Admin</strong></p>

<ul>
<li>Manage All Memberships <span class="glyphicon glyphicon-ok"></span></li>
<li>Manage Credit Requests <span class="glyphicon glyphicon-ok"></span></li>
<li>Manage Referral Request <span class="glyphicon glyphicon-ok"></span></li>
</ul>

		</div>
		
		<div class="col-md-4">
					<h4>Employee Module</h4>
					
<p><strong>Actor: Employee</strong></p>

<ul>
<li>View Personal Info <span class="glyphicon glyphicon-ok"></span></li>
<li>Update Personal Info <span class="glyphicon glyphicon-ok"></span></li>
<li>Update Password <span class="glyphicon glyphicon-ok"></span></li> 
<li>Register Account <span class="glyphicon glyphicon-ok"></span></li>
<li>View Strikes <span class="glyphicon glyphicon-ok"></span></li>
<li>Log in to CRM <span class="glyphicon glyphicon-ok"></span></li>
</ul>

<p><strong>Actor: Admin</strong></p>

<ul>
<li>View Employee List <span class="glyphicon glyphicon-ok"></span></li>
<li>Suspend Employee Account <span class="glyphicon glyphicon-ok"></span></li>
<li>Update Employees Info <span class="glyphicon glyphicon-ok"></span></li>
<li>View Strikes <span class="glyphicon glyphicon-ok"></span></li>
<li>Modify Strikes <span class="glyphicon glyphicon-ok"></span></li>
</ul>
		</div>
		<div class="col-md-4">
					<h4>Sales Module</h4>
					
<p><strong>Actor: Employee</strong></p>

<ul>
<li>View Sales Targets  <span class="glyphicon glyphicon-ok"></span></li>
<li>Add New Sale  <span class="glyphicon glyphicon-ok"></span></li>
<li>View Daily Sales  <span class="glyphicon glyphicon-ok"></span></li>
<li>View Sale  <span class="glyphicon glyphicon-ok"></span></li>
<li>Delete Sale  <span class="glyphicon glyphicon-ok"></span></li>
<li>Update Sale  <span class="glyphicon glyphicon-ok"></span></li>
<li>Get Receipt Code  <span class="glyphicon glyphicon-ok"></span></li>
<li>Search Sales  <span class="glyphicon glyphicon-ok"></span></li>
<li>Process Return  <span class="glyphicon glyphicon-ok"></span></li>
<li>View Daily Sales Summary  <span class="glyphicon glyphicon-ok"></span></li>
<li>Send Daily Sales Summary Report  <span class="glyphicon glyphicon-ok"></li>
</ul>

<p><strong>Actor: Admin</strong></p>

<ul>
<li>Mangage Sales  <span class="glyphicon glyphicon-ok"></span></li>
	<ul>
		<li>View Sales by Period of Time  <span class="glyphicon glyphicon-ok"></span></li>
        <li>View Sales by Store and View All  <span class="glyphicon glyphicon-ok"></span></li>
		<li>View Sale Detail <b>Not required</b></li>
		<li>Delete Sale <b>Not required</b></li>
	</ul>
<li>View Model Trends<span class="glyphicon glyphicon-ok"></span></li>
    <ul>    
        <li>By period of time  <span class="glyphicon glyphicon-ok"></span></li>
        <li>By sale status  <span class="glyphicon glyphicon-ok"></span></li>
        <li>View All  <span class="glyphicon glyphicon-ok"></span></li>
    </ul>
<li>Manage Sales Target  <span class="glyphicon glyphicon-ok"></span></li>
	<ul>
		<li>Set Sales Targets  <span class="glyphicon glyphicon-ok"></span></li>
		<li>View Sales Progress  <span class="glyphicon glyphicon-ok"></span></li>
	</ul>
</ul>
	
		
	</div>
    </div>
				
</div>
    </div>
<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>