#A5 Deliverables
* Assignment-5 template document: /documents/A5/BTS530Assn-5.docx
* To run the code use the link: (http://www.amorvincitomnia.ca/BTS/koodoMobileCRM/salesManagementModule/addSale.php)

#How to access live demo
Live demo with source code on the github can be accessed using following url:

Link [bts530.jgchoi.ca](http://bts530.jgchoi.ca)

Server Demo Updated on Oct. 19, 2015 10:00 AM

#List of Use Cases
##Membership Module (JGCHOI)
**Actor: Employee** 
* Activate VIP
* Add Credit
* Add Membership
* Search Membership with ID
* Redeem Credit
* Redeem VIP Privileges
* Request Referral
* Update Membership Profile
* View Credit Transaction
* View Membership Detail
* View Requests Status

**Actor: Admin**
* Manage All Memberships
* Manage Credit Requests
* Manage Referral Request

##Employee Module
**Actor: Employee** (Michael)
* View Personal Info 
* Update Personal Info
* Update Password
* Register Account
* View Strikes
* Log in to CRM

**Actor: Admin**
* View Employee List
* Suspend Employee Account
* Update Employees Info
* View Strikes
* Delete Strikes
* Modify Strikes

##Sales Module 
**Actor: Employee** (Ravideep)
* Add New Sale
* View Daily Sales
* View Sale Detail
* Update Sale
* Delete Sale
* Get Receipt Code
* Get Daily Sales Summary
* Send Daily Sales Summary Report
* Search Sales
* Process Return
* Review Sales Targets

**Actor: Admin** (Max and Michael)
* View Sales		
* View Per Model Selling Trend
* Manage Sales Target
* Review Sales Target Progress

#Library & Files Struecture

'Http_root/bts530/koodoMobileCRM/'

koodoMobileCRM - forlder has all resources folders like images, scripts, fonts, library, and modules

each modules folders under koodoMobileCRM should contains php files for user view.

php files should not be on the koodoMobileCRM, and each module folder should not have any sub folders.

Sample php file is on the salesManagementModule/index.php - Please review

The index.php on koodoMobileCRM has 1 function: redirect to 'AccountManagmentModule/login.php' which will be the first page for CRM.

#Update Note
##19/10/2015
Removed 2 modules
- Operation Module
- Customer Module
##09/10/2015

// http://www.w3schools.com/bootstrap/bootstrap_tooltip.asp
Add the data-toggle="tooltip" attribute to an element.
Use the title attribute to specify the text that should be displayed inside the tooltip
Eg.:

`<a href="#" data-toggle="tooltip" title="Hooray!">Hover over me</a>`

##27/09/2015

To add your own customized css file for your age / module:

1) Add css file to css folder with name: yourmodule_custom.css

2) Use function : writeHeaderCss("path_To_Css_File") instead of writeHeader().

writeHeader() can still be used, if you dont need a css file

eg:

<?php
	//This is Page Template
	include("../library/library.php");
	$menu = new Menu();
	$header = new Header();
	$footer = new Footer();
	$cssPath = "../css/deleteThis.css";
	$header->writeHeaderCss($cssPath);
	$menu->writeMenu("sale");
?>

##27/09/2015

`$menu->writeMenu() function has been changed to $menu->writeMenu("menuItemName")`

The name must be one of the 6 main menu items => home, sales, customer, membership, operations or admin

ALl lowercase

The specified link will display as active link
 No newline at end of file
