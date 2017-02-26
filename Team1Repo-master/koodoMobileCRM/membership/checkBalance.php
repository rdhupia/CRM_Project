 <?php
	include("../library/library.php");
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();

    $membership;

    if($_POST){
        $membershipId = $_POST['membershipId'];
        $membership = Membership::withId($membershipId);
    }
	
	$header->writeHeader();?>
<body>
<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <div style="padding-top:2%;"></div>
            <div class="row text-center">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <img src="../img/wc_logo_large_transparent.png" class="img img-responsive">
                    </div>
                </div>
            </div>
            <h1 class="page-header">Membership
                <small>Check Credit</small>
            </h1>

        </div>
    </div>
    <div class="jumbotron">
        <?php if(!$_POST){?>
    <form method="post" >
        <div class="row">
            <div class="input-group col-md-6 col-md-offset-3 searchBar">
                <input type="text" maxlength="6" name="membershipId" class="form-control" placeholder="Membership Number" required pattern="[\d]{6}" title="Membership number needs to be 6 numeric digits">
								  <span class="input-group-btn">
									<input type="submit"  name="firstProcess" value="search" class="btn btn-default form-control">

								  </span>

            </div>

        </div>
    </form>
    <br>
    <div class="text-center">
       <small> Check your WorldComm Membership Balance Here!
        Enter your membership id on the card below and click submit</small>
    </div>
    <br><?php } else { ?>




			<div class="row text-center">
				<h3> Search Result </h3>
				<h2>Membership ID: <?php print $membership->id;?></h2>
				<h2>Balance : $ <?php print $membership->balance;?></h2>
                <a href="<?php print $_SERVER['PHP_SELF'];?>" class="btn btn-default"   >Start New Search</a>
			</div>

        <?php } ?>
    </div>

	<div class="jumbotron">
			<div class="row text-center">
				<h3>Membership Terms and Conditions</h3><br>
				<small>Only one membership card can be used for each transaction. World Comm.-CT membership and its membership credit is not transferrable. Membership card must be presented to invoke membership privileges. Membership services can only be used at the locations specified on the membership card. Membership credit does not have any monetary value. Membership credit cannot be used for handset purchases or Koodo mobile service payments. Terms and conditions are subject to change without notice. VIP membership expires in one year from the date of VIP activation. Membership owners are responsible to keep the membership card and any personal information safe. World Comm.-CT will not be responsible for any loss of the credit or services due to the owners' mistakes. There is a replacement fee is $10 if the card is lost. Friend referral credit will be applied 8 weeks after the activation. Friend referral credits are void if the referred account is being cancelled within 8 weeks post activation. VIP premium terms and services can be changed without notice All products & services purchased with WorldComm membership credit are final sale. Credit received for Koodo activation must be fully paid if customer return or cancel either of their handset or service. Membership credit purchases cannot be combined with any other store promotions. Credit restore for lost/stolen card may take up to 4 weeks. Any disagreement/dispute over membership credit balance will be settled by the transaction records on our system whereas, World Comm.-CT has no obligation to prove the transaction records to customers. Membership registration is final sale.</small>
			</div>
    </div>
</div>


</body>
<?php
	$footer->writeFooter();
?>