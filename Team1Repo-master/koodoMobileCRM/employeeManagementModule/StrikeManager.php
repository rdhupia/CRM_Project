

<?php

   include("../library/library.php");
	$menu = new Menu();
	$err="";
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("View Strikes");
	
?>
    
	<h2 class="text-center"> Strikes of [employee name] </h2><hr>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
			<tr>
				<th class="col-sm-10 col-md-10">TIME STAMP</th>
				<th class="col-sm-10 col-md-10">REASON</th>
				<th class="col-sm-2 col-md-2">ACTIONS</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td> Filler </td>
				<td> Filler </td>
				<td>
					<div class="btn-group" role="group" aria-label="..."> 
						<button type="button" class="btn btn-default"  data-toggle="tooltip" title="Edit">
							<span class="glyphicon glyphicon-pencil"></span> 
						</button>
						<button type="button" class="btn btn-danger"  data-toggle="tooltip" title="Delete">
							<span class="glyphicon glyphicon-trash"></span>
						</button>
					</div>
				</td>
			</tr>
			</tbody>
			
		</table>
		</div>
		<hr>
		<button type="button" class="btn btn-warning" >
			<a href="addStrike.php">Add Strike </a>
		</button>
	</div>


<?php
	$footer->writeFooter();
?>
