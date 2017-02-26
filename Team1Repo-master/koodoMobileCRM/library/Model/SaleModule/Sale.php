<?php
include_once("../library/DBLink.php");

class Sale {
	
	private static $tableName = "sale";
	
	// Table columns
	private $id;
	private $dateOfSale;
	private $userId;
	private $typeCode;
	private $koodoServiceId;
	private $storeCode;
	private $primaryIdCode;
	private $secondaryIdCode;
	
	
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
            $this->dateOfSale = $row['dateOfSale'];
            $this->userId = $row['userId'];
            $this->typeCode = $row['typeCode'];
            $this->koodoServiceId = $row['koodoServiceId'];
            $this->storeCode = $row['storeCode'];
            $this->primaryIdCode = $row['primaryIdCode'];
            $this->secondaryIdCode = $row['secondaryIdCode'];
            $this->id = $row['id'];
        }
    }
    
    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
    
    // Update a Sale
    public function update($typeCode, $koodoServiceId, $storeCode, 
    $primaryIdCode, $secondaryIdCode ){
        $dblink = new DBLink();

        $typeCode = $dblink->getStringForQuery($typeCode);
        $koodoServiceId = $dblink->getStringForQuery($koodoServiceId);
        $storeCode = $dblink->getStringForQuery($storeCode);
        $primaryIdCode = $dblink->getStringForQuery($primaryIdCode);
        $secondaryIdCode = $dblink->getStringForQuery($secondaryIdCode);

        //Update Sale
        $query = "UPDATE ".self::$tableName." SET
					typeCode = '".$typeCode."',
					koodoServiceId = '".$koodoServiceId."',
					storeCode = '".$storeCode."',
					primaryIdCode = '".$primaryIdCode."',
                    secondaryIdCode = '".$secondaryIdCode."'
					WHERE id = ".$this->id.";";
        $dblink->query($query);
    }
	
	//Add new Sale return saleId
	public static function addNew($userId, $typeCode, $koodoServiceId, 
    $storeCode, $primaryIdCode, $secondaryIdCode ){
        $dblink = new DBLink();
        
        $userId = $dblink->getStringForQuery($userId);
        $typeCode = $dblink->getStringForQuery($typeCode);
        $koodoServiceId = $dblink->getStringForQuery($koodoServiceId);
        $storeCode = $dblink->getStringForQuery($storeCode);
        $primaryIdCode = $dblink->getStringForQuery($primaryIdCode);
        $secondaryIdCode = $dblink->getStringForQuery($secondaryIdCode);

        //Add new Sale
        $query = "INSERT INTO ".self::$tableName." SET
					userId = '".$userId."',
					typeCode = '".$typeCode."',
					koodoServiceId = '".$koodoServiceId."',
					storeCode = '".$storeCode."',
					primaryIdCode = '".$primaryIdCode."',
                    secondaryIdCode = '".$secondaryIdCode."';";
		$dblink->query($query);
		$saleId = $dblink->getLastInsertedId();
        
		//Return Sale Id
		return $saleId;
	}

    
    // Returns result set of all sales of the current day, else returns false;
	public static function getTodaysSales() {
        // Connect to DataBase
        $dblink = new DBLink();
		$query = "SELECT * FROM sale WHERE dateOfSale >= CURDATE() AND dateOfSale < CURDATE() + INTERVAL 1 DAY ORDER BY dateOfSale;";
		// $query = "SELECT * FROM sale WHERE DATE(dateOfSale) = CURDATE() ORDER BY dateOfSale;";
		
		// Run sql query
		$result = $dblink->query($query);
		
		// Obtain the resulting records
		if( mysqli_num_rows($result) < 1 ) {
			return false;
		}
        
		return $result;
	}
    
    public static function getSalesByUser($userId, $month, $year) {
        if( $month !=  NULL && $year != NULL ) {
            $timestamp = strtotime( $month.' '.$year ); 
        }
        $from_date = date('Y-m-01 00:00:00', $timestamp);
        $to_date  = date('Y-m-t 12:59:59', $timestamp);
        
        // Connect to DataBase
        $dblink = new DBLink();
		$query = "SELECT COUNT(*) FROM sale INNER JOIN salestatus ON sale.id = salestatus.saleId WHERE sale.userId = ".$userId." 
            AND (sale.typeCode = 'K' OR sale.typeCode = 'T') AND sale.dateOfSale 
            BETWEEN '".$from_date."' AND '".$to_date."' AND salestatus.status = 'sold';";
            
		// Run sql query
		$result = $dblink->query($query);
        $count = mysqli_fetch_array($result);
		return $count[0]; 
    }
    
    public static function getSalesBySearchTerm($keyword) {
       $column  = "";
       if(strlen($keyword)==15) {
            $column = "imeiNumber";
        }
        else if(strlen($keyword)==19) {
            $column = "simNumber";
        }
        else if(strlen($keyword)==10) {
            $column = "phoneNumber";
        }
         
        // Connect to DataBase
        $dblink = new DBLink();
		$query = "SELECT * FROM koodoservice INNER JOIN sale ON sale.koodoServiceId = koodoservice.id 
            WHERE koodoservice.".$column." = '".$keyword."';";
            
		// Run sql query
		$result = $dblink->query($query);
        return $result;
    }
    
    
    // Returns result set of all sales between the dates, else returns false;
	public static function getSales($from_date, $to_date, $store) {
        if($from_date == NULL) {
            $from_date = Date('2000-01-01');
        }
        if($to_date == NULL)
            $to_date = date('Y-m-d H:i:s');
            
        if($store === "A")
            $store = "_";    // Any single character
            
        $to_date = date('Y-m-d', strtotime($to_date . ' +1 day'));    
        // Connect to DataBase
        $dblink = new DBLink();
		$query = "SELECT * FROM sale WHERE storeCode LIKE '".$store."' AND dateOfSale BETWEEN '".$from_date."' AND '".$to_date."' ORDER by dateOfSale DESC;";
        //$query = "SELECT * FROM sale WHERE dateOfSale >= CURDATE() AND dateOfSale < CURDATE() + INTERVAL 1 DAY ORDER BY dateOfSale;";
		// $query = "SELECT * FROM sale WHERE DATE(dateOfSale) = CURDATE() ORDER BY dateOfSale;";
		
		// Run sql query
		$result = $dblink->query($query);
		
		// Obtain the resulting records
		if( mysqli_num_rows($result) < 1 ) {
			return false;
		}
        
		return $result;
	}
    
     
    // Get count of sales of a particular type for a given store
    public static function getSaleTypeCount($typeCode, $storeCode) {
        $dblink = new DBLink();
        $query = "SELECT COUNT(*) FROM ".self::$tableName." WHERE typeCode = '".$typeCode."' AND storeCode = '".$storeCode."';";
        $result = $dblink->query($query);
        $count = mysqli_fetch_array($result);
        return $count[0];
    }
    
    // Get models count
    public static function getModelCount($from_date, $to_date, $store, $status, $modelCodesResultSet) {
        $dblink = new DBLink();
        
        $store = $dblink->getStringForQuery($store);
        $status = $dblink->getStringForQuery($status);
        
        if($from_date == NULL) {
            $from_date = Date('2000-01-01');
        }
        if($to_date == NULL)
            $to_date = date('Y-m-d H:i:s');
            
        if($store === "A")
            $store = "_";    // Any single character
            
        $to_date = date('Y-m-d', strtotime($to_date . ' +1 day'));   
        
        $counts = array();
        
        while($row = mysqli_fetch_assoc($modelCodesResultSet)) {
            $query = "SELECT COUNT(*) FROM sale JOIN koodoservice ON sale.koodoServiceId = koodoservice.id 
                    WHERE koodoservice.modelCode = '".$row['code']."' AND koodoservice.saleStatus = '".$status."' AND sale.storeCode LIKE '".$store."' 
                    AND sale.dateOfSale BETWEEN '".$from_date."' AND '".$to_date."';";
            $result = $dblink->query($query);
            $count = mysqli_fetch_array($result);
            $counts[] = $count[0];
        }
        return $counts;
        
    }

}
?>