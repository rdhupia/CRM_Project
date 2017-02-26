 <?php
	
	include("../library/library.php");
	session_start();
	if (!isset($_SESSION['current_user'])){
      header("location:login.php");
      exit();
	}
	$editer=$_SESSION['current_user'];
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	
	$header->writeHeader();
	$menu->writeMenu("MyInfo");
?>

<body>
	<div class="container body-content">
		<div class="row">
			<h3>Manage users</h3>
		</div>	
		<br>
		<hr>
		<br>
		
		<div class="table-responsive">
		
			  <table class="table table-bordered table-hover">
			  	<thead>
			  		<tr>
			  			<th class="col-sm-1 col-md-1">USER NAME</th>
			  			<th class="col-sm-1 col-md-1">FIRST NAME</th>
			  			<th class="col-sm-1 col-md-1">LAST NAME</th>			  			
						<th class="col-sm-2 col-md-1">PHONE NUMBER</th>
			  			<th class="col-sm-2 col-md-2">EMAIL ADDRESS</th>
			  			<th class="col-sm-1 col-md-2">HOME ADDRESS</th>
			  			<th class="col-sm-1 col-md-1">STRIKES</th>
						<th class="col-sm-1 col-md-1">ACTIONS</th>
			  		</tr>
			  	</thead>
				
				<tbody>
				<?php
				$user= new User();
				$result=$user->getAllUsers();
				while($row=mysqli_fetch_assoc($result)){
				
				$strike= new Strike();
				$address= new Address();
				$address->loadById($row['addressId']);
				$street=$address->getStreet();
				$city=$address->getCity();
				$province=$address->getProvince();
				$postalCode=$address->getPostalCode();
				$totalStrikes=mysqli_num_rows($strike->loadByCustomerId($row['id']));
				if($row['id']!=$editer->getId()){
				?>
				
				<tr>
					<td><?php echo $row['userName']; ?></td>
					<td><?php echo $row['firstName']; ?></td>
					<td><?php echo $row['lastName']; ?></td>
					<td> <?php echo $row['phoneNumber']; ?></td>
					<td><?php echo $row['emailAddress']; ?></td>
					<td><?php echo $street?><br><?php echo $city?><br><?php echo $province?><br><?php echo $postalCode; ?></td>
						

					<td><a href=ViewStrikes.php?id=<?php echo $row['id']?> ><button class="btn btn-primary btn-sm"><?php echo $totalStrikes?></button></a></td>
					<td>
						<div class="btn-group" role="group" aria-label="...">
							<a href="./EditUser.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-default"  data-toggle="tooltip" title="Edit" >
								<span class="glyphicon glyphicon-pencil" ></span> 
							</button></a>
							
							<?php if($row['isActive']==1){ ?>
							<a href="ToggleStatus.php?id=<?php echo $row['id']?>">
							<button type="button" class="btn btn-danger"  data-toggle="tooltip" title="Suspend">
								<span class="glyphicon glyphicon-lock"></span> 
							</button>
							</a>
							<?php } ?>
							<?php if($row['isActive']==0){ ?>
							<a href="ToggleStatus.php?id=<?php echo $row['id']?>">
							<button type="button" class="btn btn-success"  data-toggle="tooltip" title="Activate">
								<span class="glyphicon glyphicon-ok"></span> 
							</button>
							</a>
							<?php } ?>
						</div>
					</td> 	
						   
				</tr>
				<?php
				}
				}
				?>
				</tbody>
		    </table>
		</div> 
		<!--- /TABLE-RESPONSIVE -->
		
	</div>
<?php
	$footer->writeFooter();
?>