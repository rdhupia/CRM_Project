<?php
include_once("../library/DBLink.php");

class KoodoAccount {
	
	private static $tableName = "koodoaccount";
	
	// Table columns
	private $id;
	private $accountPin;
	private $accountNumber;   // text
	private $customerId;
	private $billingCycle;
    
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
            $this->customerId = $row['customerId'];
            $this->id = $row['id'];
            $this->accountNumber = $row['accountNumber'];
            $this->accountPin = $row['accountPin'];
            $this->billingCycle = $row['billingCycle'];
        }
    }
    
    
    // -- Public Static functions --
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
    
    //Update Koodo Account return koodoAccountId
	public function update($accountNumber, $accountPin, $billingCycle) {
        $dblink = new DBLink();
      
        $accountNumber = $dblink->getStringForQuery($accountNumber);
        $accountPin = $dblink->getStringForQuery($accountPin);
        $billingCycle = $dblink->getStringForQuery($billingCycle);
        
		//Insert New Customer	
		$query = "UPDATE ".self::$tableName." SET
					accountNumber = '".$accountNumber."',
					accountPin = '".$accountPin."',
					billingCycle = '".$billingCycle."'
                    WHERE id = ".$this->id.";";
                    
		$dblink->query($query);
	}
	    
    //Add new Koodo Account return koodoAccountId
	public static function addNew($customerId, $accountNumber,
	$accountPin, $billingCycle) {
        $dblink = new DBLink();
        
        $customerId = $dblink->getStringForQuery($customerId);
        $accountNumber = $dblink->getStringForQuery($accountNumber);
        $accountPin = $dblink->getStringForQuery($accountPin);
        $billingCycle = $dblink->getStringForQuery($billingCycle);
        
		//Insert New Customer	
		$query = "INSERT INTO ".self::$tableName." SET
					customerId = ".$customerId.",
					accountNumber = '".$accountNumber."',
					accountPin = '".$accountPin."',
					billingCycle = '".$billingCycle."';";
                    
		$dblink->query($query);
		$koodoAccountId = $dblink->getLastInsertedId();
        
		//Return KoodoAccount Id
		return $koodoAccountId;
	}
       
    //Check if Koodo Account exists for the account number. 
    //Return Koodo account id if found, else return false
	public static function isExist($accountNumber){
         $dblink = new DBLink();
        
        $accountNumber = $dblink->getStringForQuery($accountNumber);
        
		$query = "SELECT id FROM ".self::$tableName." WHERE 
				accountNumber = '".$accountNumber."'";
        
		$result = $dblink->query($query);
        
		//Return false if not found
		if($dblink->isEmpty()){
			return false;
		}
		
		$row = mysqli_fetch_assoc($result);
		$koodoAccountId = $row['id'];
		return $koodoAccountId;
			
	}
}
?>