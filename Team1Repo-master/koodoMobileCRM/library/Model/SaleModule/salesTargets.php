<?php
include_once("../library/DBLink.php");
 
class SalesTargets{
    private static $tableName = "salesTargets";
    
	//Private Properties
	private $id;
	private $month;
	private $year;
	private $userId;
	private $salesTarget;
    private $accTarget;
    private $progress;

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
            $this->month = $row['month'];
            $this->year = $row['year'];
            $this->userId = $row['userId'];
            $this->salesTarget = $row['salesTarget'];
            $this->accTarget = $row['accTarget'];
            $this->progress = $row['progress'];
        }
    } 
    
    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }

    //Add new sales target and get sales target id 
	public static function addNew($month, $year, $userId, $salesTarget, $accTarget){
        
        $dblink = new DBLink();
        
        $month = $dblink->getStringForQuery($month);
        $year = $dblink->getStringForQuery($year);
        $userId = $dblink->getStringForQuery($userId);
        $salesTarget = $dblink->getStringForQuery($salesTarget);
        $accTarget = $dblink->getStringForQuery($accTarget);
        		
        //Insert sales targets
		$query = "INSERT INTO ".self::$tableName." SET
					month = '".$month."',
					year = '".$year."',
					userId = '".$userId."',
                    salesTarget = '".$salesTarget."',
                    accTarget = '".$accTarget."';";
                    
		$dblink->query($query);
		$salesTargetId = $dblink->getLastInsertedId();
        
		//Return Sale target Id
		return $salesTargetId;
	}
    
    // Update sales target of given user for given month and year
    public static function updateSalesTargets( $month, $year, $userId, 
    $salesTarget, $accTarget){
        
        $dblink = new DBLink();
        
        $month = $dblink->getStringForQuery($month);
        $year = $dblink->getStringForQuery($year);
        $userId = $dblink->getStringForQuery($userId);
        $salesTarget = $dblink->getStringForQuery($salesTarget);
        $accTarget = $dblink->getStringForQuery($accTarget);
		
        //Insert sales targets
		$query = "UPDATE ".self::$tableName." SET
                    salesTarget = '".$salesTarget."',
                    accTarget = '".$accTarget."'
                    WHERE month = '".$month."' AND
					year = '".$year."' AND
					userId = '".$userId."';";
                    
		$dblink->query($query);
    }
    
    // returns targets set for a user for given month and year
    public static function getSetTargets($month, $year, $userId) {
        
        $dblink = new DBLink();
        $month = $dblink->getStringForQuery($month);
        $year = $dblink->getStringForQuery($year);
        $userId = $dblink->getStringForQuery($userId);
                
        // Check if sale is not deleted and not returned
        $query = "SELECT * FROM ".self::$tableName." WHERE month = '".$month."'
                    AND year = ".$year." AND userId = ".$userId.";";
        $result = $dblink->query($query);
        return $result;
    }   
    
    // Check if targets are set for a user for a given month and year
    public static function isTargetSet($month, $year, $userId) {
        
        $dblink = new DBLink();
        $month = $dblink->getStringForQuery($month);
        $year = $dblink->getStringForQuery($year);
        $userId = $dblink->getStringForQuery($userId);
                
        // Check if sale is not deleted and not returned
        $query = "SELECT * FROM ".self::$tableName." WHERE month = '".$month."'
                    AND year = ".$year." AND userId = ".$userId.";";
        $result = $dblink->query($query);
        $row_cnt = mysqli_num_rows($result);
        
        if($row_cnt >= 1)
            return true;
        else
            return false; 
    }   
    
    // Delete a record
    public static function reset($month, $year, $userId) {
        $dblink = new DBLink();
        $month = $dblink->getStringForQuery($month);
        $year = $dblink->getStringForQuery($year);
        $userId = $dblink->getStringForQuery($userId);
        
        // Remove row with sales target id
        $query = "DELETE FROM ".self::$tableName."  
                    WHERE month = '".$month."' AND
					year = '".$year."' AND
					userId = '".$userId."';";
        $dblink->query($query);
    }

}
?>