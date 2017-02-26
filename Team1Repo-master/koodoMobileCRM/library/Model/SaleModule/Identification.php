<?php
include_once("../library/DBLink.php");

class Identification {
    private static $tableName = "identification";
    
	//Private Properties
	private $code;
	private $description;
	private $type;

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
            $this->description = $row['description'];
            $this->type = $row['type'];
        }
    }

    //public static methods
    public static function withId($code){
        $instance = new self();
        $instance->loadById($code);
        return $instance;
    }
    
    // Get all codes and descriptions for the identification type
    public static function getAllCodesDescriptions($identificationType) {
        $dblink = new DBLink();
        $query = "SELECT code, description FROM ".self::$tableName." WHERE type = '".$identificationType."';";
        $result = $dblink->query($query);
        return $result;
    }
}
?>