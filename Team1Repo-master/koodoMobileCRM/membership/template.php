<?php
	include("../library/library.php");
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	
	$header->writeHeader();
	$menu->writeMenu("membership");
?>

<!-- HEADER -->
<header class="container">
	<div class="row">
		<h2>Site Title</h2>
	</div>
</header>
<!-- /HEADER -->
<!-- MAIN CONTENT -->
<div class="main-content container-fluid">

</div>
<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>