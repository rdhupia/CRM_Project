<?php
include_once("../../DBLink.php");

class User{
	//Private Properties
	private $addressId;
	private $adminLevel;
	private $emailAddress;
	private $firstName;
	private $id;
	private $isActive;
	private $lastName;
	private $passwordHash;
	private $userName;
	private $dblink;
	
	//Public Methods
	function __construct () {
		//Open DB Link
		$this->dblink = new DBLink();
	}
	
	function __construct ($balance, $customerId, $id, $startDate, $VIPStartDate) {
		$this->dblink = new DBLink();
		
		$this->balance = $balance;
		$this->id = $id;
		$this->customerId = $customerId;
		$this->startDate = $startDate;
		$this->VIPStartDate = $VIPStartDate;
	}
	
	function __construct ($id) {
		$this->dblink = new DBLink();
		
		$query = "SELECT * FROM membership WHERE id = ".$id.";";
		$result = $this->dblink->query($query);
		$row = mysqli_fetch_assoc($result);
			$membership = new Membership(
				$row['balance'],
				$row['customerId'],
				$row['id'],
				$row['startDate'],
				$row['VIPStartDate']);
			
		return $memberships;
	}
	
	function addNewMembership($customerId, $membershipId){
		//Insert New Member	
		$query = "INSERT INTO membership SET
					customerId = ".$customerId.",
					id = ".$membershipId.";";
		$this->dblink->query($query);
		
		//Return Membership Id
		return $membershipId;
	}
	
	function isVIP(){
		if($this->VIPStartDate != null)
			return true;
		return false;
	}
	
	function activateVIP(){
		$query = "Update membership SET
					VIPStartDate = '".date ("Y-m-d H:i:s", $phptime)."';";
		
		$this->dblink->query($query);
	}
	
	//---- Admin Methods ----
	function getAllMembership(){
		$query = "SELECT * FROM membership";
		$result = $this->dblink->query($query);
		$memberships;
		while($row = mysqli_fetch_assoc($result)){
			$membership = new Membership(
				$row['balance'],
				$row['customerId'],
				$row['id'],
				$row['startDate'],
				$row['VIPStartDate']);
			$memberships = $membership;
		}
		return $memberships;
	}
	
	function deactivateVIP(){
		
		
		$query = "Update membership SET
					VIPStartDate = null';";
		
		$this->dblink->query($query);
	}
	
}