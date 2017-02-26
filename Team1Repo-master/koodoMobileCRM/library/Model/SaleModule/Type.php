<?php
include_once("../library/DBLink.php");

class Type {
    private static $tableName = "type";
    
	//Private Properties
	private $code;
	private $category;
	private $description;

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
            $this->category = $row['category'];
            $this->description = $row['description'];        }
    }

    //public static methods
    public static function withId($code){
        $instance = new self();
        $instance->loadById($code);
        return $instance;
    }
    
    // Get all codes and descriptions for prepaid or postpaid serivce
    public static function getAllCodesDescriptions($service) {
        $dblink = new DBLink();
        if($service === NULL)
            $query = "SELECT code, description FROM ".self::$tableName.";";
        else
            $query = "SELECT code, description FROM ".self::$tableName." WHERE category = '".$service."';";
        $result = $dblink->query($query);
        return $result;
    }
   
}
?>