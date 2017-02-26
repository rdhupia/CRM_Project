<?php
include_once("../library/DBLink.php");

class Customer{
    private static $tableName = "customer";
    
	//Private Properties
	private $addressId;
	private $email;
	private $firstName;
	private $id;
	private $lastName;
	private $phoneNumber;
	private $phoneNumber2;

    //Getter & Setter Magic Method!
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
	
    //--- Protected method
    protected function loadById($id) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->addressId = $row['addressId'];
            $this->email = $row['email'];
            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->phoneNumber2 = $row['phoneNumber2'];
            $this->id = $row['id'];
        }
    }

    public function update($firstName, $lastName, $phoneNumber, $phoneNumber2, $email){
        $dblink = new DBLink();

        $email = $dblink->getStringForQuery($email);
        $firstName = $dblink->getStringForQuery($firstName);
        $lastName = $dblink->getStringForQuery($lastName);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        $phoneNumber2 = $dblink->getStringForQuery($phoneNumber2);

        //Update Customer
        $query = "UPDATE ".self::$tableName." SET
					email = '".$email."',
					firstName = '".$firstName."',
					lastName = '".$lastName."',
					phoneNumber = '".$phoneNumber."',
					phoneNumber2 = '".$phoneNumber2."'
					WHERE id = ".$this->id.";";
        $dblink->query($query);
    }
	
	//Add new customer return customerId
	public static function addNew($addressId, $email, $firstName,
	$lastName, $phoneNumber, $phoneNumber2){
        $dblink = new DBLink();
        
        $addressId = $dblink->getStringForQuery($addressId);
        $email = $dblink->getStringForQuery($email);
        $firstName = $dblink->getStringForQuery($firstName);
        $lastName = $dblink->getStringForQuery($lastName);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        $phoneNumber2 = $dblink->getStringForQuery($phoneNumber2);
        
		//Insert New Customer	
		$query = "INSERT INTO ".self::$tableName." SET
					addressId = ".$addressId.",
					email = '".$email."',
					firstName = '".$firstName."',
					lastName = '".$lastName."',
					phoneNumber = '".$phoneNumber."',
					phoneNumber2 = '".$phoneNumber2."';";
		$dblink->query($query);
		$customerId = $dblink->getLastInsertedId();
        
		//Return Customer Id
		return $customerId;
	}

    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
	
	//Check if customer exists and return customerId if found
	public static function isExist($email, $firstName, $lastName, $phoneNumber){
         $dblink = new DBLink();
        
        $email = $dblink->getStringForQuery($email);
        $firstName = $dblink->getStringForQuery($firstName);
        $lastName = $dblink->getStringForQuery($lastName);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        
		$query = "SELECT id FROM ".self::$tableName." WHERE 
				email = '".$email."' AND
				firstName = '".$firstName."' AND
				lastName = '".$lastName."' AND
				phoneNumber = '".$phoneNumber."'";
        
		$result = $dblink->query($query);
        
		//Return false if not found
		if($dblink->isEmpty()){
			return false;
		}
		
		$row = mysqli_fetch_assoc($result);
		$customerId = $row['id'];
		return $customerId;
			
	}
}
?>