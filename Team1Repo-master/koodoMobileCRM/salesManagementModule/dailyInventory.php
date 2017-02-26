<?php
	//This is Page Template
	include("../library/library.php");
    // Get current user object
    $user = User::isUser();

	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
    $today = date("d-m-Y");
    $success = false;
	
    if($_POST) {
        $to = "rsdhupia@gmail.com";
		$headers = 'From: user@koodomobile.com' . "\r\n" .
				  'Cc: junggeonc@gmail.com' . "\r\n" .
				  'Bcc: rdhupia@myseneca.ca' . "\r\n" .
                 'Reply-To: user@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
        $subject = "Inventory Report ".$today;
        $message = "SIM INVENTORY"."\r\n" .
                   "SS: "."\t".$_POST['one']."\r\n"."MS: "."\t".$_POST['two']."\r\n"."NS: \t".$_POST['three']."\r\n".
                   "PPSS: \t".$_POST['four']."\r\n"."PPMS: \t".$_POST['five']."\r\n"."PPNS: \t".$_POST['six']."\r\n"."\r\n".
                   "PUBLIC MOBILE SIM"."\r\n".
                   "Public SS: \t".$_POST['seven']."\r\n"."Public MS: \t".$_POST['eight']."\r\n"."\r\n".
                   "PHONE INVENTORY"."\r\n".
                   "C_GS3_B: \t".$_POST['ten']."\r\n"."C_MTG: \t".$_POST['eleven']."\r\n"."C_NOTE2: \t".$_POST['twelve']."\r\n"."K_A392A: \t".$_POST['nine']."\r\n".
                   "K_CORE_B: \t".$_POST['thirteen']."\r\n"."K_CORE_W: \t".$_POST['fourteen']."\r\n"."K_GS3_B: \t".$_POST['fifteen']."\r\n".
                   "K_GS3_W: \t".$_POST['sixteen']."\r\n"."K_GS4_B: \t".$_POST['seventeen']."\r\n"."K_GS4_W: \t".$_POST['eighteen']."\r\n".
                   "K_GS5: \t".$_POST['nineteen']."\r\n"."K_I4S_B: \t".$_POST['twenty']."\r\n"."K_I4S_W: \t".$_POST['twentyone']."\r\n".
                   "K_I5C_WH: \t".$_POST['twentytwo']."\r\n"."K_I5S_GL: \t".$_POST['twentythree']."\r\n"."K_I6P_16GB: \t".$_POST['twentyfour']."\r\n".
                   "K_I6_16GB: \t".$_POST['twentyfive']."\r\n"."K_I6_64GB: \t".$_POST['twentysix']."\r\n"."K_LGG3: \t".$_POST['twentyseven']."\r\n".
                   "K_MTE_B: \t".$_POST['twentyeight']."\r\n"."K_MTE_W: \t".$_POST['twentynine']."\r\n"."K_MTG: \t".$_POST['thirty']."\r\n".
                   "K_NEX5: \t".$_POST['thirtyone']."\r\n"."K_NOTE4: \t".$_POST['thirtytwo']."\r\n"."P_D320: \t".$_POST['thirtythree']."\r\n".
                   "P_MTG: \t".$_POST['thirtyfour']."\r\n"."P_Y330: \t".$_POST['thirtyfive']."\r\n"."U_7024W: \t".$_POST['thirtysix']."\r\n".
                   "U_FIERCE2: \t".$_POST['thirtyseven']."\r\n"."U_GGIO: \t".$_POST['thirtyeight']."\r\n"."U_GS2: \t".$_POST['thirtynine']."\r\n".
                   "U_GS3_747: \t".$_POST['forty']."\r\n"."U_GS3_999: \t".$_POST['fortyone']."\r\n"."U_GS3_999_32G: \t".$_POST['fortytwo']."\r\n".
                   "U_GS4: \t".$_POST['fortythree']."\r\n"."U_GS5: \t".$_POST['fortyfour']."\r\n"."U_GW300: \t".$_POST['fortyfive']."\r\n".
                   "U_I4S: \t".$_POST['fortysix']."\r\n"."U_I5C: \t".$_POST['fortyseven']."\r\n"."U_I5_32G: \t".$_POST['fortyeight']."\r\n".
                   "U_L70: \t".$_POST['fortynine']."\r\n"."U_L90: \t".$_POST['fifty']."\r\n"."U_LIGHT: \t".$_POST['fiftyone']."\r\n".
                   "U_NEX4: \t".$_POST['fiftytwo']."\r\n"."U_NOTE2: \t".$_POST['fiftythree']."\r\n"."U_NOTE3: \t".$_POST['fiftyfour']."\r\n".
                   "U_T599: \t".$_POST['fiftyfive']."\r\n"."U_XPZ: \t".$_POST['fiftysix']."\r\n"."U_Y330: \t".$_POST['fiftyseven']."\r\n".
                   "U_Z10: \t".$_POST['fiftyeight']."\r\n"."U_Z221: \t".$_POST['fiftynine']."\r\n"."\r\n".
                   "COMMENT"."\r\n".
                   $_POST['comment']."\r\n";"\r\n".
      
      $success = mail( $to, $subject, $message, $headers );
    }
    
	$header->writeHeader();
	$menu->writeMenu("sale");
	?>

		<!-- HEADER -->
		<header class="container">
			<div class="row">
				<h2>Daily Counts</h2>
			</div>
		</header>
		<!-- /HEADER -->

		<!-- MAIN CONTENT -->
		<div class="main-content container">
			<h3>Daily Inventory for: <?php print $today; ?></h3>
			<!-- Collapsible panels -->
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="panel-group col-md-6" id="accordion">
				<div class="panel panel-info" >
					<div class="panel-heading">
						<h4 class="panel-title"><a href="#collapse1" data-toggle="collapse" data-parent="accordion">SIM INVENTORY</a></h4>
					</div>
					<div class="panel-collapse collapse in" id="collapse1"> 
						<div class="panel-body">
						
							<div class="form-group">
								<label for="countSS" class="col-sm-2 control-label">SS</label>
								<div class="col-sm-2">
									<input type="text" name="one" class="form-control" id="countSS" placeholder="0">
								</div>
								<label for="countMS" class="col-sm-2 control-label">MS</label>
								<div class="col-sm-2">
									<input type="text" name="two" class="form-control" id="countMS" placeholder="0">
								</div>
								<label for="countNS" class="col-sm-2 control-label">NS</label>
								<div class="col-sm-2">
									<input type="text" name="three" class="form-control" id="countNS" placeholder="0">
								</div>
							 </div>
							 <div class="form-group">
								<label for="countPPSS" class="col-sm-2 control-label">PPSS</label>
								<div class="col-sm-2">
									<input type="text" name="four" class="form-control" id="countPPSS" placeholder="0">
								</div>
								<label for="countPPMS" class="col-sm-2 control-label">PPMS</label>
								<div class="col-sm-2">
									<input type="text" name="five" class="form-control" id="countPPMS" placeholder="0">
								</div>
								<label for="countPPNS" class="col-sm-2 control-label">PPNS</label>
								<div class="col-sm-2">
									<input type="text" name="six" class="form-control" id="countPPNS" placeholder="0">
								</div>
							 </div>
						
						</div>
					</div>
				</div>
				<div class="panel panel-warning" >
					<div class="panel-heading">
						<h4 class="panel-title"><a href="#collapse2" data-toggle="collapse" data-parent="accordion">PUBLIC MOBILE SIM</a></h4>
					</div>
					<div class="panel-collapse collapse" id="collapse2">
						<div class="panel-body">
						
							<div class="form-group">
								<label for="countPubSS" class="col-sm-2 control-label">Public SS</label>
								<div class="col-sm-2">
									<input type="text" name="seven" class="form-control" id="countPubSS" placeholder="0">
								</div>
								<label for="countPubMS" class="col-sm-2 control-label">Public MS</label>
								<div class="col-sm-2">
									<input type="text" name="eight" class="form-control" id="countPubMS" placeholder="0">
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="panel panel-success" >
					<div class="panel-heading">
						<h4 class="panel-title"><a href="#collapse3" data-toggle="collapse" data-parent="accordion">PHONE INVENTORY</a></h4>
					</div>
					<div class="panel-collapse collapse" id="collapse3">
						<div class="panel-body">
						
							<div class="form-group">
								<label for="countC_GS3_B" class="col-sm-2 control-label">C_GS3_B</label>
								<div class="col-sm-2">
									<input type="text" name="nine" class="form-control" id="countC_GS3_B" placeholder="0">
								</div>
								<label for="countC_MTG" class="col-sm-2 control-label">C_MTG</label>
								<div class="col-sm-2">
									<input type="text" name="ten" class="form-control" id="countC_MTG" placeholder="0">
								</div>
								<label for="countC_NOTE2" class="col-sm-2 control-label">C_NOTE2</label>
								<div class="col-sm-2">
									<input type="text" name="eleven" class="form-control" id="countC_NOTE2" placeholder="0">
								</div>
							 </div>
							 <div class="form-group">
								<label for="countK_A392A" class="col-sm-2 control-label">K_A392A</label>
								<div class="col-sm-2">
									<input type="text" name="twelve" class="form-control" id="countK_A392A" placeholder="0">
								</div>
								<label for="countK_CORE_B" class="col-sm-2 control-label">K_CORE_B</label>
								<div class="col-sm-2">
									<input type="text" name="thirteen" class="form-control" id="countK_CORE_B" placeholder="0">
								</div>
								<label for="countK_CORE_W" class="col-sm-2 control-label">K_CORE_W</label>
								<div class="col-sm-2">
									<input type="text" name="fourteen" class="form-control" id="countK_CORE_W" placeholder="0">
								</div>
							 </div>
							 
							 
							 <div class="form-group">
								<label for="countK_GS3_B" class="col-sm-2 control-label">K_GS3_B</label>
								<div class="col-sm-2">
									<input type="text" name="fifteen" class="form-control" id="countK_GS3_B" placeholder="0">
								</div>
								<label for="countK_GS3_W" class="col-sm-2 control-label">K_GS3_W</label>
								<div class="col-sm-2">
									<input type="text" name="sixteen" class="form-control" id="countK_GS3_W" placeholder="0">
								</div>
								<label for="countK_GS4_B" class="col-sm-2 control-label">K_GS4_B</label>
								<div class="col-sm-2">
									<input type="text" name="seventeen" class="form-control" id="countK_GS4_B" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countK_GS4_W" class="col-sm-2 control-label">K_GS4_W</label>
								<div class="col-sm-2">
									<input type="text" name="eighteen" class="form-control" id="countK_GS4_W" placeholder="0">
								</div>
								<label for="countK_GS5" class="col-sm-2 control-label">K_GS5</label>
								<div class="col-sm-2">
									<input type="text" name="nineteen" class="form-control" id="countK_GS5" placeholder="0">
								</div>
								<label for="countK_I4S_B" class="col-sm-2 control-label">K_I4S_B</label>
								<div class="col-sm-2">
									<input type="text" name="twenty" class="form-control" id="countK_I4S_B" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countK_I4S_W" class="col-sm-2 control-label">K_I4S_W</label>
								<div class="col-sm-2">
									<input type="text" name="twentyone" class="form-control" id="countK_I4S_W" placeholder="0">
								</div>
								<label for="countK_I5C_WH" class="col-sm-2 control-label">K_I5C_WH</label>
								<div class="col-sm-2">
									<input type="text" name="twentytwo" class="form-control" id="countK_I5C_WH" placeholder="0">
								</div>
								<label for="countK_I5S_GL" class="col-sm-2 control-label">K_I5S_GL</label>
								<div class="col-sm-2">
									<input type="text" name="twentythree" class="form-control" id="countK_I5S_GL" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countK_I6P_16GB" class="col-sm-2 control-label">K_I6P_16GB</label>
								<div class="col-sm-2">
									<input type="text" name="twentyfour" class="form-control" id="countK_I6P_16GB" placeholder="0">
								</div>
								<label for="countK_I6_16GB" class="col-sm-2 control-label">K_I6_16GB</label>
								<div class="col-sm-2">
									<input type="text" name="twentyfive" class="form-control" id="countK_I6_16GB" placeholder="0">
								</div>
								<label for="countK_I6_64GB" class="col-sm-2 control-label">K_I6_64GB</label>
								<div class="col-sm-2">
									<input type="text" name="twentysix" class="form-control" id="countK_I6_64GB" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countK_LGG3" class="col-sm-2 control-label">K_LGG3</label>
								<div class="col-sm-2">
									<input type="text" name="twentyseven" class="form-control" id="countK_LGG3" placeholder="0">
								</div>
								<label for="countK_MTE_B" class="col-sm-2 control-label">K_MTE_B</label>
								<div class="col-sm-2">
									<input type="text" name="twentyeight" class="form-control" id="countK_MTE_B" placeholder="0">
								</div>
								<label for="countK_MTE_W" class="col-sm-2 control-label">K_MTE_W</label>
								<div class="col-sm-2">
									<input type="text" name="twentynine" class="form-control" id="countK_MTE_W" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countK_MTG" class="col-sm-2 control-label">K_MTG</label>
								<div class="col-sm-2">
									<input type="text" name="thirty" class="form-control" id="countK_MTG" placeholder="0">
								</div>
								<label for="countK_NEX5" class="col-sm-2 control-label">K_NEX5</label>
								<div class="col-sm-2">
									<input type="text" name="thirtyone" class="form-control" id="countK_NEX5" placeholder="0">
								</div>
								<label for="countK_NOTE4" class="col-sm-2 control-label">K_NOTE4</label>
								<div class="col-sm-2">
									<input type="text" name="thirtytwo" class="form-control" id="countK_NOTE4" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countP_D320" class="col-sm-2 control-label">P_D320</label>
								<div class="col-sm-2">
									<input type="text" name="thirtythree" class="form-control" id="countP_D320" placeholder="0">
								</div>
								<label for="countP_MTG" class="col-sm-2 control-label">P_MTG</label>
								<div class="col-sm-2">
									<input type="text" name="thirtyfour" class="form-control" id="countP_MTG" placeholder="0">
								</div>
								<label for="countP_Y330" class="col-sm-2 control-label">P_Y330</label>
								<div class="col-sm-2">
									<input type="text" name="thirtyfive" class="form-control" id="countP_Y330" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_7024W" class="col-sm-2 control-label">U_7024W</label>
								<div class="col-sm-2">
									<input type="text" name="thirtysix" class="form-control" id="countU_7024W" placeholder="0">
								</div>
								<label for="countU_FIERCE2" class="col-sm-2 control-label">U_FIERCE2</label>
								<div class="col-sm-2">
									<input type="text" name="thirtyseven" class="form-control" id="countU_FIERCE2" placeholder="0">
								</div>
								<label for="countU_GGIO" class="col-sm-2 control-label">U_GGIO</label>
								<div class="col-sm-2">
									<input type="text" name="thirtyeight" class="form-control" id="countU_GGIO" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_GS2" class="col-sm-2 control-label">U_GS2</label>
								<div class="col-sm-2">
									<input type="text" name="thirtynine" class="form-control" id="countU_GS2" placeholder="0">
								</div>
								<label for="countU_GS3_747" class="col-sm-2 control-label">U_GS3_747</label>
								<div class="col-sm-2">
									<input type="text" name="forty" class="form-control" id="countU_GS3_747" placeholder="0">
								</div>
								<label for="countU_GS3_999" class="col-sm-2 control-label">U_GS3_999</label>
								<div class="col-sm-2">
									<input type="text" name="fortyone" class="form-control" id="countU_GS3_999" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_GS3_999_32G" class="col-sm-2 control-label">U_GS3_999_32G</label>
								<div class="col-sm-2">
									<input type="text" name="fortytwo" class="form-control" id="countU_GS3_999_32G" placeholder="0">
								</div>
								<label for="countU_GS4" class="col-sm-2 control-label">U_GS4</label>
								<div class="col-sm-2">
									<input type="text" name="fortythree" class="form-control" id="countU_GS4" placeholder="0">
								</div>
								<label for="countU_GS5" class="col-sm-2 control-label">U_GS5</label>
								<div class="col-sm-2">
									<input type="text" name="fortyfour" class="form-control" id="countU_GS5" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_GW300" class="col-sm-2 control-label">U_GW300</label>
								<div class="col-sm-2">
									<input type="text" name="fortyfive" class="form-control" id="countU_GW300" placeholder="0">
								</div>
								<label for="countU_I4S" class="col-sm-2 control-label">U_I4S</label>
								<div class="col-sm-2">
									<input type="text" name="fortysix" class="form-control" id="countU_I4S" placeholder="0">
								</div>
								<label for="countU_I5C" class="col-sm-2 control-label">U_I5C</label>
								<div class="col-sm-2">
									<input type="text" name="fortyseven" class="form-control" id="countU_I5C" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_I5_32G" class="col-sm-2 control-label">U_I5_32G</label>
								<div class="col-sm-2">
									<input type="text" name="fortyeight" class="form-control" id="countU_I5_32G" placeholder="0">
								</div>
								<label for="countU_L70" class="col-sm-2 control-label">U_L70</label>
								<div class="col-sm-2">
									<input type="text" name="fortynine" class="form-control" id="countU_L70" placeholder="0">
								</div>
								<label for="countU_L90" class="col-sm-2 control-label">U_L90</label>
								<div class="col-sm-2">
									<input type="text" name="fifty" class="form-control" id="countU_L90" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_LIGHT" class="col-sm-2 control-label">U_LIGHT</label>
								<div class="col-sm-2">
									<input type="text" name="fiftyone" class="form-control" id="countU_LIGHT" placeholder="0">
								</div>
								<label for="countU_NEX4" class="col-sm-2 control-label">U_NEX4</label>
								<div class="col-sm-2">
									<input type="text" name="fiftytwo" class="form-control" id="countU_NEX4" placeholder="0">
								</div>
								<label for="countU_NOTE2" class="col-sm-2 control-label">U_NOTE2</label>
								<div class="col-sm-2">
									<input type="text" name="fiftythree" class="form-control" id="countU_NOTE2" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_NOTE3" class="col-sm-2 control-label">U_NOTE3</label>
								<div class="col-sm-2">
									<input type="text" name="fiftyfour" class="form-control" id="countU_NOTE3" placeholder="0">
								</div>
								<label for="countU_T599" class="col-sm-2 control-label">U_T599</label>
								<div class="col-sm-2">
									<input type="text" name="fiftyfive" class="form-control" id="countU_T599" placeholder="0">
								</div>
								<label for="countU_XPZ" class="col-sm-2 control-label">U_XPZ</label>
								<div class="col-sm-2">
									<input type="text" name="fiftysix" class="form-control" id="countU_XPZ" placeholder="0">
								</div>
							 </div>
							 
							 <div class="form-group">
								<label for="countU_Y330" class="col-sm-2 control-label">U_Y330</label>
								<div class="col-sm-2">
									<input type="text" name="fiftyseven" class="form-control" id="countU_Y330" placeholder="0">
								</div>
								<label for="countU_Z10" class="col-sm-2 control-label">U_Z10</label>
								<div class="col-sm-2">
									<input type="text" name="fiftyeight" class="form-control" id="countU_Z10" placeholder="0">
								</div>
								<label for="countU_Z221" class="col-sm-2 control-label">U_Z221</label>
								<div class="col-sm-2">
									<input type="text" name="fiftynine" class="form-control" id="countU_Z221" placeholder="0">
								</div>
							 </div>
							 
						</div>
					</div>
				</div>
						
			</div>
				<div class="form-group col-md-6">
					<textarea class="form-control" rows="4" name="comment" placeholder="Comments"></textarea>
				</div>								
				<?php if($success) echo "Report sent successfully!";?>
				<div class="span7 text-right">
					<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> Submit</span></button>
				</div>
			
			</form>
		
		</div>
		
		<!-- /MAIN CONTENT -->

<?php
	$footer->writeFooter();
?>