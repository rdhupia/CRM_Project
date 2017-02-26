<?php
include_once("../library/DBLink.php");

class Strike{
    private static $tableName = "strike";
    
	//Private Properties
	private $id;
	private $userId;
	private $adminId;
	private $timestamp;
	private $comment;
	private $status;

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
        $query = "SELECT * FROM ".self::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        return $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->userId = $row['userId'];
            $this->adminId = $row['adminId'];
            $this->timestamp = $row['timestamp'];
            $this->comment = $row['comment'];
            $this->status = $row['status'];
            $this->id = $row['id'];
        }
    }

    public function update($status, $reason){
        $dblink = new DBLink();

        $status = $dblink->getStringForQuery($status);
        $reason = $dblink->getStringForQuery($reason);
		$id=$this->id;

        //update strike
        $query = "UPDATE ".self::$tableName." SET
					status = '".$status."',
					comment = '".$reason."'
					WHERE id = ".$id.";";
        $dblink->query($query);
    }
	
	//Add new strike return strikeId
	public function loadResultById($id) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        return $row;
	}
	
	public function loadByCustomerId($id) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE userId = ".$id.";";
		$result = $dblink->query($query);
        return $result;
	}
	public function loadByUserId($id) {
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE userId = ".$id." AND status = active;";
		$result = $dblink->query($query);
        return $result;
	}
	
	public function getUserId() {
        return $this->userId;
	}
	public function getTimestamp() {
        return $this->timestamp;
	}
	public function getComment() {
        return $this->comment;
	}
	public function getStatus() {
        return $this->status;
	}


	
	
	public static function addNew($userId, $adminId,
	$comment, $status){
        $dblink = new DBLink();
        
        $userId = $dblink->getStringForQuery($userId);
        $adminId = $dblink->getStringForQuery($adminId);
        $comment = $dblink->getStringForQuery($comment);
        $status = $dblink->getStringForQuery($status);
        
		//Insert New Customer	
		$query = "INSERT INTO ".self::$tableName." SET
					userId = ".$userId.",
					adminId = '".$adminId."',
					comment = '".$comment."',
					status = '".$status."';";
		$dblink->query($query);
		$strikeId = $dblink->getLastInsertedId();
        
		//Return Membership Id
		return $strikeId;
	}

    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }

	
	//Check if customer is exist and return customerId if found
	public static function isExist($email, $firstName, $lastName, $phoneNumber){
         $dblink = new DBLink();
    
        $email = $dblink->getStringForQuery($email);
        $firstName = $dblink->getStringForQuery($firstName);
        $lastName = $dblink->getStringForQuery($lastName);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        
		$query = "SELECT id FROM ".self::$tableName." WHERE 
				email = '".$email."' AND
				firstName = '".$firstName."' AND
				lastName = '".$lastName."' AND
				phoneNumber = '".$phoneNumber."'";
        
		$result = $dblink->query($query);
        
		//Return false if not found
		if($dblink->isEmpty()){
			return false;
		}
		
		$row = mysqli_fetch_assoc($result);
		$customerId = $row['id'];
		return $customerId;
			
	}
}
?>