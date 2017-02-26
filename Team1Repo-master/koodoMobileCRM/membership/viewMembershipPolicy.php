<?php
	include("../library/library.php");
$user = User::isUser();
Header::write();
Menu::write("membership");
	?>

    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Membership
                    <small>Policy</small>
                </h1>

            </div>
        </div>
        <!-- MAIN CONTENT -->
<div class="main-content container-fluid">
	<div class="row">
		<h3>Membership Rule (Regular)</h3>
	</div>
    <ol>
        <li>Sign up fee : $10 or free with accessory purchase</li>
        <li>Referral Credit : $15</li>
        <li>Accessory discount Rate : 10%</li>
    </ol>
	<div class="row">
		<h3>Membership Rule (VIP)</h3>
	</div>
    <ol>
        <li>Sign up fee : $30</li>
        <li>Referral Credit : $25</li>
        <li>Accessory Discount : 15%</li>
        <li>Handset Discount : $10</li>
        <li>Period : 2 Year</li>
        <li>VIP Privileges
            <ul>
                <li>2 Screen protector + Installation</li>
                <li>2 Handset cleaning</li>
                <li>2 Smart Phone Optimization</li>
                <li>2 Battery calibration</li>
                <li>Unlocking Discount 13%</li>
                <li>Phone charging service</li>
                <li>Contact back-up service</li>
            </ul>
        </li>
    </ol>

	<div class="row">
		<h3>Membership Number</h3>
	</div>
    <ol>
        <li>Membership management system use 6 digits for membership number</li>
        <li>First digit is set by the type of the card
            <ul>
                <li>'9' for VIP card</li>
                <li>'1' for regular card</li>
            </ul>
        </li>
        <li>Following 5 digits are same as last 5 digits from the membership card number
            <ul>
                <li>If regular membership card has "64735 64650 001305", membership number is "101305"</li>
                <li>If VIP membership card has "20141 00000 000025", membership number is "900025"</li>
            </ul>
        </li>
        <li>Possible range for regular card: 100001 ~ 101700</li>
        <li>Possible range for VIP card: 900001 ~ 900300</li>

    </ol>

	<div class="row">
		<h3>Membership Terms and Condition</h3>
	</div>
				
	<h5> Last modified on 2015-10-01 </h5>
    <ol>
        <li>Only one membership card can be used for each transaction.</li>
        <li>World Comm.-CT membership and its membership credit is not transferrable.</li>
        <li>Membership card must be presented to invoke membership privileges.</li>
        <li>Membership services can only be used at the locations specified on the membership card.</li>
        <li>Membership credit does not have any monetary value.</li>
        <li>Membership credit cannot be used for handset purchases or Koodo mobile service payments</li>
        <li>Membership credit cannot be used for handset purchases or Koodo mobile service payments</li>
        <li>Terms and conditions are subject to change without notice</li>
        <li>VIP membership expires in one year from the date of VIP activation.</li>
        <li>Membership owners are responsible to keep the membership card and any personal information safe. World Comm.-CT will not be responsible for any loss of the credit or services due to the owners' mistakes.</li>
        <li>There is a replacement fee is $10 if the card is lost.</li>
        <li>Friend referral credit will be applied 8 weeks after the activation.</li>
        <li>VIP premium terms and services can be changed without notice</li>
        <li>All products & services purchased with WorldComm membership credit are final sale.</li>
        <li>Credit received for Koodo activation must be fully paid if customer return or cancel either of their handset or service.</li>
        <li>Membership credit purchases cannot be combined with any other store promotions.</li>
        <li>Credit restore for lost/stolen card may take up to 4 weeks.</li>
        <li>Any disagreement/dispute over membership credit balance will be settled by the transaction records on our system whereas, World Comm.-CT has no obligation to prove the transaction records to customers.</li>
        <li>Membership registration is final sale.</li>

    </ol>
	</div>
</div>
<!-- /MAIN CONTENT -->

<?php
Footer::write();
?>