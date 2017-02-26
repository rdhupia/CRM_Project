<?php
include_once("../library/DBLink.php");

class Store {
    private static $tableName = "store";
    
	//Private Properties
	private $code;
	private $phoneNumber;
	private $addressId;
    private $storeName;

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
    protected function loadById($code) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE code = '".$code."';";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->code = $row['code'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->addressId = $row['addressId'];
            $this->storeName = $row['storeName'];
        }
    }

    //Add new store and return storeId
	public static function addNew($code, $phoneNumber, $addressId, $storeName){
        $dblink = new DBLink();
        
        $code = $dblink->getStringForQuery($code);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        $addressId = $dblink->getStringForQuery($addressId);
        
		//Insert New Sale Status	
		$query = "INSERT INTO ".self::$tableName." SET
                    code = '".$code."',
					phoneNumber = '".$phoneNumber."',
					addressId = '".$addressId."'
                    storeName = '".$storeName."';";
                    
		$dblink->query($query);
		$storeId = $dblink->getLastInsertedId();
        
		//Return Sale Satus Id
		return $storeId;
	}

    //public static methods
    public static function withId($code){
        $instance = new self();
        $instance->loadById($code);
        return $instance;
    }
}
?>