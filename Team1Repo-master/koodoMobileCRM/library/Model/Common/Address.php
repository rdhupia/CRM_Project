<?php
include_once("../library/DBLink.php");

class Address{
    private static $tableName = "address";
    
	//Private Properties
	private $id;
	private $street;
	private $city;
	private $province;
	private $postalCode;

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
    public function loadById($id) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".Address::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->id = $row['id'];
            $this->street = $row['street'];
            $this->city = $row['city'];
            $this->province = $row['province'];
            $this->postalCode = $row['postalCode'];
        }
    }
	//public methods
    public function update($street, $city, $province, $postalCode){
        $dblink = new DBLink();

        $street = $dblink->getStringForQuery($street);
        $city = $dblink->getStringForQuery($city);
        $province = $dblink->getStringForQuery($province);
        $postalCode = $dblink->getStringForQuery($postalCode);

        //Insert New Customer
        $query = "UPDATE ".Address::$tableName." SET
					city = '".$city."' ,
					postalCode = '".$postalCode."' ,
                    province = '".$province."' ,
					street = '".$street."'
					WHERE id = ".$this->id.";";

        $dblink->query($query);
    }
	public function getStreet(){
		return $this->street;
	}
	public function getCity(){
		return $this->city;
	}
	public function getProvince(){
		return $this->province;
	}
	public function getPostalCode(){
		return $this->postalCode;
	}
    
    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
	
	public function checkAddress($street, $city, $province,$postalCode){
		
		$dblink = new DBLink();
        
        $street = $dblink->getStringForQuery($street);
        $city = $dblink->getStringForQuery($city);
        $province = $dblink->getStringForQuery($province);
        $postalCode = $dblink->getStringForQuery($postalCode);
		
		$query = "SELECT id FROM ".self::$tableName." Where
					city = '".$city."' AND
					postalCode = '".$postalCode."' AND
					province = '".$province."' AND
					street = '".$street."'";
		
		$result=$dblink->query($query);
		$match=mysqli_num_rows($result);
		
		
		if($match==0)
			return $this->addNew($street, $city, $province, $postalCode);
			
		$row=mysqli_fetch_assoc($result);
		return $row['id'];
	}
	
	//Add new address return addressId
	public static function addNew($street, $city, $province,$postalCode)
	{
        $dblink = new DBLink();
        
        $street = $dblink->getStringForQuery($street);
        $city = $dblink->getStringForQuery($city);
        $province = $dblink->getStringForQuery($province);
        $postalCode = $dblink->getStringForQuery($postalCode);

		//Insert New Address	
		$query = "INSERT INTO ".self::$tableName." SET
					city = '".$city."' ,
					postalCode = '".$postalCode."' ,
					province = '".$province."' ,
					street = '".$street."'";
					
		$dblink->query($query);
		
		//GET Address ID and 
		$addressId = $dblink->getLastInsertedId();
		return $addressId;
	}	
}
?>