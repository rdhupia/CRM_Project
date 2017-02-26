<?php
class Header
{
	private $path;
	
	public static function write(){
		$instance = new self();
		$instance->writeHeader();
	}
	public function writeHeader()
	{
		?>
		<!DOCTYPE html>
		<html lang="en">

			<head>
				
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				
				<meta name="description" content="Customer Relation Management system, Koodo Mobile, WorldComm. CT, Back-end system.">
				<meta name="keywords" content="CRM, back-end, Koodo, WorldComm, employee, membership, operations, sales">
				
				<title>WorldComm CT.</title>
				<link rel="shortcut icon" href="../img/favi.ico" type="image/x-icon"/>
			
				<!-- BOOTSTRAP: Latest compiled and minified CSS -->
				<link rel="stylesheet" href="../css/bootstrap.min.css">

				<!-- BOOTSTRAP: Optional theme -->
				<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
				
				<!-- CUSTOM -->
				<link rel="stylesheet" href="../css/custom.css">
				<link rel="stylesheet" href="../css/font-awesome.min.css">    <!-- Twitter, FB Logos etc-->
				
			</head>

		<?php
	}
	
	public function writeHeaderCss( $pathToCss ) {
	
		if( empty($pathToCss) )
			$this->path = "";
		else
			$this->path = "<link rel=\"stylesheet\" href=\"".$pathToCss."\">"; 
		{
		?>
		<!DOCTYPE html>
		<html lang="en">

			<head>
				
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				
				<meta name="description" content="Customer Relation Management system, Koodo Mobile, WorldComm. CT, Back-end system.">
				<meta name="keywords" content="CRM, back-end, Koodo, WorldComm, employee, membership, operations, sales">
				
				<title>WorldComm CT.</title>
				<link rel="shortcut icon" href="../img/favi.ico" type="image/x-icon"/>
			
				<!-- BOOTSTRAP: Latest compiled and minified CSS -->
				<link rel="stylesheet" href="../css/bootstrap.min.css">

				<!-- BOOTSTRAP: Optional theme -->
				<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
				
				<!-- CUSTOM -->
				<link rel="stylesheet" href="../css/custom.css">
				<link rel="stylesheet" href="../css/font-awesome.min.css">    <!-- Twitter, FB Logos etc-->
		        <?php echo $this->path; ?> 
				
			</head>

		<?php
		}
	}
}
?>