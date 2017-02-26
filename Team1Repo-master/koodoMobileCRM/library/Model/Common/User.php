<?php
include_once("../library/DBLink.php");

class User{
    private static $tableName = "user";
    
	//Private Properties
	private $id;
	private $addressId;
	private $firstName;
	private $lastName;
	private $userName;
	private $passwordHash;
	private $phoneNumber;
	private $emailAddress;
	private $adminLevel;
	private $isActive;
	private $storeCode;
    //...
	
    //--- Protected method
    public function loadById($id) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->id = $row['id'];
			$this->firstName=$row['firstName'];
			$this->lastName =$row['lastName'];
			$this->userName =$row['userName'];
			$this->addressId=$row['addressId'];
			$this->phoneNumber=$row['phoneNumber']; 
			$this->passwordHash =$row['passwordHash'];
			$this->emailAddress =$row['emailAddress'];
			$this->adminLevel =$row['adminLevel'];
			$this->isActive =$row['isActive'];
        }
    }
    
    //public static methods
    public function getFirstName(){
		return $this->firstName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	public function toggleStatus(){
	$dblink = new DBLink();
		if($this->isActive==0)
		{
			$this->isActive=1;
		}
		else
		{
			$this->isActive=0;
		}
		
		$query = "UPDATE ".self::$tableName." SET
					isActive = ".$this->isActive."
					WHERE id = ".$this->id.";";
        $dblink->query($query);
		
	}
	
	public function getFullName($userID){
		$instance = new self();
        $instance->loadById($userID);
		return $instance->getFirstName()." ".$instance->getLastName();
	}
	
	public function getUserName(){
		return $this->userName;
	}
	public function getPhoneNumber(){
		return $this->phoneNumber;
	}
	public function getEmailAddress(){
		return $this->emailAddress;
	}
	public function getAdminLevel(){
		return $this->adminLevel;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getAddressId(){
		return $this->addressId;
	}
	
	public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
	
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }
	
	public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }

    public static function getUserNameWihtId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance->userName;
    }
	
	public static function withUserName($user){
	
//		$dblink = new DBLink();
//        $query = "SELECT * FROM ".self::$tableName." WHERE userName = ".$user.";";
//		$result = $dblink->query($query);
//		$row = mysqli_fetch_assoc($result);
//        $this->fill($row);
//
//        $instance = new self();
//        $instance->loadById($id);
//        return $instance;
    }

    public function checkPassword($currentPassword){
		$cryptPassword=crypt($currentPassword,$this->passwordHash);
		if($cryptPassword==$this->passwordHash){
			return true;
		}
		else{
			return false;
		}
	}
	public function updatePassword($newPassword){
        $dblink = new DBLink();
		$cryptPassword=crypt($newPassword);
       
        //update strike
        $query = "UPDATE ".self::$tableName." SET
					passwordHash = '".$cryptPassword."'
					WHERE id = ".$this->id.";";
        $dblink->query($query);
    }
	public function update($streetAddress, $city,$province,$postalCode, $phoneNumber, $email){
        $dblink = new DBLink();
		$address= new Address();
		$this->addressId=$address->checkAddress($streetAddress, $city,$province,$postalCode);
        $email = $dblink->getStringForQuery($email);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);

        //update strike
        $query = "UPDATE ".self::$tableName." SET
					emailAddress = '".$email."',
					phoneNumber = '".$phoneNumber."',
					addressId='".$this->addressId."'
					WHERE id = ".$this->id.";";
        $dblink->query($query);
    }
	
	
	public function login($user,$password,$store){
	
		$dblink = new DBLink();
		
		//************
		$query = "SELECT passwordHash from user where userName= '$user'";
		
		$result = $dblink->query($query);
		$row=mysqli_fetch_assoc($result);
		$cryptPassword=crypt($password,$row['passwordHash']);
		$compareQuery="SELECT * FROM ".self::$tableName.' WHERE userName="'.$user.'"AND passwordHash="'.$cryptPassword.'"AND isActive='. 1;
		$result= $dblink->query($compareQuery);
		$match=mysqli_num_rows($result);
		if($match=0)
			return null;
		
		$row=mysqli_fetch_assoc($result);
		
		//************
        $this->fill($row);
		$this->setStore($store);
        return $this;
    }
	
	public function setStore($store){
		$this->storeCode=$store;
	}
	public function signedIn(){
		return $this->isActive;
	}

    public static function getCurrentUser(){
        return $_SESSION['current_user'];
    }
	
	//Add new customer return customerId    
	public static function addNew($firstN, $lastN, $User, $password, $phoneNum,$emailAdd, $addId, $aLevel, $isA){//...
        $dblink = new DBLink();
        
        $street = $dblink->getStringForQuery($street);	
        //....

		//Insert New Customer	
		$query = "INSERT INTO ".self::$tableName." SET
					firstName='".$firstN."',
					lastName='".$lastN."',
					userName='".$User."',
					passwordHash='".$password."',
					phoneNumber='".$phoneNum."',
					addressId='".$addId."',
					emailAddress='".$emailAdd."',
					adminLevel='".$aLevel."',
					isActive = '".$isA."'";
					
		$dblink->query($query);
		
		//GET Address ID and 
		$addressId = $dblink->getLastInsertedId();
		return $addressId;
	}	
	
	public static function getAllUsers() {
        $dblink = new DBLink();
        
        $query = "SELECT * FROM ".self::$tableName.";";
        $result = $dblink->query($query);
        
        if($dblink->isEmpty()) {
            return false;
        }
        
        return $result;
    }

    //---- Functions added by JGC ----

    //// ---- Check if user is log in & user
    public static function isUser(){
    	session_start();
    	if (!isset($_SESSION['current_user'])){
            header("location:../employeeManagementModule/logout.php");
      		exit();
		}
        return $_SESSION['current_user'];
    }

    //// ---- Check if user is log in & adimn
    public function adminAccess(){
    	if ($this->adminLevel != 9){
    		//Destory session
    		//logout
            header("location:../employeeManagementModule/logout.php");
      		exit();
  		}
    }


    public function isAdmin(){
        return $this->adminLevel == 9;
    }
	
}
?>