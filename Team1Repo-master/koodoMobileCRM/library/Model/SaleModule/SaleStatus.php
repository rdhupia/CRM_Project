<?php
include_once("../library/DBLink.php");

class SaleStatus{
    private static $tableName = "salestatus";
    
	//Private Properties
	private $id;
	private $status;
	private $userId;
	private $saleId;
	private $timestamp;

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
            $this->id = $row['id'];
            $this->status = $row['status'];
            $this->userId = $row['userId'];
            $this->saleId = $row['saleId'];
            $this->timestamp = $row['timestamp'];
        }
    }

    //Add new sale status and return saleStatusId
	public static function addNew($status, $userId, $saleId){
        $dblink = new DBLink();
        
        $status = $dblink->getStringForQuery($status);
        $userId = $dblink->getStringForQuery($userId);
        $saleId = $dblink->getStringForQuery($saleId);
        
		//Insert New Sale Status	
		$query = "INSERT INTO ".self::$tableName." SET
					saleId = ".$saleId.",
					status = '".$status."',
					userId = '".$userId."';";
                    
		$dblink->query($query);
		$salestatusId = $dblink->getLastInsertedId();
        
		//Return Sale Satus Id
		return $salestatusId;
	}
    
    // Update sale status for a given saleId
    public static function updateSaleStatus($saleId, $userId, $newStatus) {
        $dblink = new DBLink();
        
        $saleId = $dblink->getStringForQuery($saleId);
        $userId = $dblink->getStringForQuery($userId);
        $newStatus = $dblink->getStringForQuery($newStatus);
        
        // Update sale status
        $query = "UPDATE ".self::$tableName." SET 
                    status = '".$newStatus."',
                    userId = '".$userId."'
                    WHERE saleId = ".$saleId.";";
        
        $dblink->query($query);
    }
    
    public static function isStatusSold($saleId) {
        $dblink = new DBLink();
        
        $saleId = $dblink->getStringForQuery($saleId);
        
        // Check if sale is not deleted and not returned
        $query = "SELECT status FROM ".self::$tableName." WHERE saleId = ".$saleId.";";
        $result = $dblink->query($query);
        $row = mysqli_fetch_assoc($result);
        
        
        if($row['status'] === "sold")
            return true;
        else
            return false;        
    }
    

    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
}
?>