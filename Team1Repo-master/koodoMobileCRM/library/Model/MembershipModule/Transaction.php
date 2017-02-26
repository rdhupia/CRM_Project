<?php
include_once("../library/DBLink.php");

class Transaction {
    private static $tableName = "transaction";
    
	private $id;
	private $storeCode;
	private $userId;
	private $VIPServiceId;
	private $amount;
	private $membershipId;
	private $celloNumber;
	private $type;
    private $timestamp;

    //Magic Method
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
        $query = "SELECT * FROM ".Transaction::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->id = $row['id'];
            $this->storeCode = $row['storeCode'];
            $this->userId = $row['userId'];
            $this->VIPServiceId = $row['VIPServiceId'];
            $this->amount = $row['amount'];
            $this->membershipId = $row['membershipId'];
            $this->celloNumber = $row['celloNumber'];
            $this->type = $row['type'];
            $this->timestamp = $row['timestamp'];
        }
    }
    
	public static function addNew($storeCode, $userId, $VIPServiceId, $amount, $membershipId, $celloNumber, $type) {
        $dblink = new DBLink();
        
         $storeCode = $dblink->getStringForQuery($storeCode);
         $userId = $dblink->getStringForQuery($userId);
         $VIPServiceId = $dblink->getStringForQuery($VIPServiceId);
         $amount = $dblink->getStringForQuery($amount);
         $membershipId = $dblink->getStringForQuery($membershipId);
         $celloNumber = $dblink->getStringForQuery($celloNumber);
         $type = $dblink->getStringForQuery($type);
        
		$query = "INSERT INTO ".Transaction::$tableName." SET
				membershipId = " . $membershipId . " ,
				VIPServiceId = " . $VIPServiceId . ",
				amount = " . $amount . ",
				type = '" . $type . "',
				storeCode = '" . $storeCode . "',
				celloNumber = '" . $celloNumber . "',
				userId = " . $userId . "";
		$dblink->query($query);
	}

	public static function withMembershipId($membershipId) {
        $dblink = new DBLink();
		$query = "SELECT * FROM ".Transaction::$tableName."
                    WHERE membershipId = ".$membershipId." AND VIPServiceId IS NULL";
                    
		$result = $dblink -> query($query);
        if($dblink->isEmpty()){
            return null;
        }
        
		//Array variable for return;
		$return;
		while($row = mysqli_fetch_assoc($result)){
			$instance = new self();
            $instance->fill($row);
			$return[] = $instance;
		}
		return $return;
	}

    public static function VIPwithMembershipId($membershipId){
        $dblink = new DBLink();
        $query = "SELECT * FROM ".Transaction::$tableName."
                    WHERE membershipId = ".$membershipId." AND VIPServiceId IS NOT NULL ";

        $result = $dblink -> query($query);
        if($dblink->isEmpty()){
            return null;
        }

        //Array variable for return;
        $return;
        while($row = mysqli_fetch_assoc($result)){
            $instance = new self();
            $instance->fill($row);
            $return[] = $instance;
        }
        return $return;
    }
}
?>