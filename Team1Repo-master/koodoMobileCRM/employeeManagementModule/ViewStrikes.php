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
	
	
	$header->writeHeader();
	$menu->writeMenu("View Strikes");
	//check to see if user is logged in
	
	
	//check to see if admin+ field is passed in
	if($_GET){
	$userID=$_GET['id'];
	}
	else
	{
		$userID=$_SESSION['current_user']->getId();
	}
	$user=new User();
	$user->loadById($userID);
	$firstName=$user->getFirstName();
	$lastName=$user->getLastName();
?>
    <!-- HEADER -->
		<header class="container">
			<div class="row">
			<?php
				if(isset($_GET['id']) &&$_SESSION['current_user']->getAdminLevel()==9){
			?>
				<h3>Strikes of <?php echo $firstName." ".$lastName?></h3>
			<?php
				}
				else
				{
			?>	
				<h3>Strikes</h3>
			<?php
				}
			?>
				
			</div>
		</header>
		<!-- /HEADER -->
		<!--
	<div class ="center-block" style="width:70%;min-width:325px;">
		<table class="table table-striped">
			<tr>
				<th style="width:20%;" > date </th>
				<th> Reason </th>
			</tr>
			<tr>
				<td> Filler </td>
				<td> Filler </td>
			</tr>
		</table>
	</div>
	michaels old stuff
	-->
	<!-- MAIN CONTENT -->
	<div class="main-content container">
		<!-- TABLE-RESPONSIVE -->
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="col-sm-1 col-md-1">Time Stamp</th> <!-- found in: strike: as: timestamp  -->
			  			<th class="col-sm-2 col-md-2">Comment</th>      <!-- found in: strike: as: comment -->
			  			<th class="col-sm-1 col-md-1">Status</th>  <!-- found in: strike: as: status   -->

					</tr>
				</thead>
				<tbody>
				<?php
				$strikes=new Strike();
				if($_GET){
				$result=$strikes->loadByCustomerId($userID);
				}
				else{
				$result=$strikes->loadByUserId($userID);
				}
				
				while($row = mysqli_fetch_assoc($result)){
				?>
					<tr>
						<td><?php echo $row['timestamp']; ?></td>
						<td><?php echo $row['comment']; ?></td>
						<td><?php echo $row['status']; ?></td>
						
					</tr>
				<?php				
				}
				?>
				
				</tbody>
			</table>
			
			<?php
			if($_GET){
				if(isset($_GET['id']) && $_SESSION['current_user']->getAdminLevel()==9){	
				?>	
				
			    <a href="UserManager.php" class="btn btn-primary col-md-1 " Style="Margin-right:5px" >Back</a> 
				<a href="addStrike.php?id=<?php echo $_GET['id']?>" class="btn btn-success col-md-1">Add New</a>
			<?php
				}
				}
			?>
		</div>
	</div>

<?php
	$footer->writeFooter();
?>














