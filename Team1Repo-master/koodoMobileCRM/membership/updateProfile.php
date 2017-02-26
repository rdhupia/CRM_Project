<?php
include("../library/library.php");
$user = User::isUser();
$membership;
$customer;
$address;

if(isset($_GET['membershipId']) && isset($_GET['hash'])){
    $membershipId = $_GET['membershipId'];

    //Security Check!
    if(!Membership::isValidHash($membershipId, $_GET['hash'])){
        //if not get..
        print "Invalid access tried from viewMembership";
        exit();
    }

    $membership = Membership::withId($membershipId);
    $customer = Customer::withId($membership->customerId);
    $address = Address::withId($customer->addressId);
}

if($_POST) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $phoneNumber2 = $_POST['phoneNumber2'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $street = $_POST['street'];

    $customer->update($firstName, $lastName, $phoneNumber, $phoneNumber2, $email);
    $address->update($street, $city, $postalCode);

    header("location:viewMembership.php?".$membership->redirectString());
}

Header::write();
Menu::write("membership");
?>

<header class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Membership
                <small>Update Profile</small>
            </h1>
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->
<div class="main-content container">

    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" method="POST">

                <div class="form-group">
                    <!--First Name-->
                    <label class="col-sm-2 control-label" for="firstName">First Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" placeholder="First Name"  value="<?php print $customer->firstName;?>"
                               name="firstName" required pattern="^[\D'.-]+$" title="Invalid Character Found">
                    </div>

                    <!--Last Name-->
                    <label class="col-sm-2 control-label" for="cusLastName">Last Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cusLastName" placeholder="Last Name" value="<?php print $customer->lastName;?>"
                               name="lastName" required pattern="^[\D'.-]+$" title="Invalid Character Found">
                    </div>
                </div>

                <!--Row 2-->
                <div class="form-group">
                    <!--Address-->
                    <label class="col-sm-2 control-label" for="cusAddress">Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cusAddress" placeholder="Address" value="<?php print $address->street;?>"
                               name ="street" required pattern="^[\D\d'.-]+$" title="Invalid Character Found">
                    </div>

                    <!--City-->
                    <label class="col-sm-2 control-label" for="cusCity">City</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cusCity" placeholder="City" value="<?php print $address->city;?>"
                               name="city" required pattern="^[\D'.-]+$" title="Invalid Character Found">
                    </div>

            </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="cusEmail">Postal Code</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cusEmail" placeholder="E-Mail Address" value="<?php print $address->postalCode;?>"
                               name="postalCode">
                    </div>

                    <label class="col-sm-2 control-label" for="cusAltCon">Phone Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cusAltCon" placeholder="Alternate Phone Number" value="<?php print $customer->phoneNumber;?>"
                               name="phoneNumber" pattern="^\d{10}$" title="Phone number must be 10 numeric digits" maxlength="10">
                    </div>
                </div>
                <div class="form-group">

                    <label class="col-sm-2 control-label" for="cusEmail">E-Mail</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="cusEmail" placeholder="E-Mail Address" value="<?php print $customer->email;?>"
                               name="email">
                    </div>

                    <label class="col-sm-2 control-label" for="cusAltCon">Alternate Number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="cusAltCon" placeholder="Alternate Phone Number" value="<?php print $customer->phoneNumber2;?>"
                               name="phoneNumber2" pattern="^\d{10}$" title="Phone number must be 10 numeric digits" maxlength="10">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <a class="btn btn-danger" href="viewMembership.php?<?php print $membership->redirectString();?>">Back</a>
                    </div>

                    <div class="col-md-4 col-md-offset-6">
                        <input type="submit" value="Update" class="btn btn-primary col-md-12">
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>
<!-- /MAIN CONTENT -->

<?php
 Footer::write();
?>















