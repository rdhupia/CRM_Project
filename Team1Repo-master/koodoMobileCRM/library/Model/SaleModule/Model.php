<?php
include_once("../library/DBLink.php");

class Model {
    private static $tableName = "model";
    
	//Private Properties
	private $code;
	private $modelDescription;
	private $modelPrice;
	private $ModelCategory;

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
        $query = "SELECT * FROM ".self::$tableName." WHERE code = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->code = $row['code'];
            $this->modelDescription = $row['modelDescription'];
            $this->modelPrice = $row['modelPrice'];
            $this->modelCategory = $row['modelCategory'];
        }
    }

    //public static methods
    public static function withId($code){
        $instance = new self();
        $instance->loadById($code);
        return $instance;
    }
    
    // Get all codes
    public static function getAllCodes() {
        $dblink = new DBLink();
        $query = "SELECT code FROM ".self::$tableName.";";
        $result = $dblink->query($query);
        return $result;
    }
}
?>