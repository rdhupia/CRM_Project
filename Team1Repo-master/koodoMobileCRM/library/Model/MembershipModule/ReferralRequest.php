<?php
include_once("../library/DBLink.php");

class ReferralRequest{
    private static $tableName = "referralRequest";
    
	private $id;
    private $comment;
	private $referralId;
	private $referringId;
	private $storeCode;
	private $status;
	private $timestamp;
	private $userId;
	private $adminId;
    private $accountNumber;
    private $phoneNumber;

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
        $query = "SELECT * FROM ".self::$tableName." WHERE id = ".$id.";";
		$result = $dblink->query($query);
		$row = mysqli_fetch_assoc($result);
        $this->fill($row);
	}
	
    protected function fill($row){
        if(is_array($row)){
            $this->comment = $row['comment'];
            $this->referralId = $row['referralId'];
            $this->referringId = $row['referringId'];
            $this->id = $row['id'];
            $this->storeCode = $row['storeCode'];
            $this->accountNumber = $row['accountNumber'];
            $this->phoneNumber = $row['phoneNumber'];
            $this->status = $row['status'];
            $this->timestamp = $row['timestamp'];
            $this->userId = $row['userId'];
            $this->adminId = $row['adminId'];
        }
    }
    
    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }

    public static function withMembershipId($membershipId){
        //Setting
        $dblink = new DBLink();

        //Make query
        $query = "SELECT * FROM ".self::$tableName;
        $query.= " WHERE referralId = '".$membershipId."';";
        $result = $dblink->query($query);

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
	
	public static function addNew($referralId, $referringId, $accountNumber, $phoneNumber, $storeCode, $userId){
        $dblink = new DBLink();
        
        $referralId = $dblink->getStringForQuery($referralId);
        $accountNumber = $dblink->getStringForQuery($accountNumber);
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        $referringId = $dblink->getStringForQuery($referringId);
        $storeCode = $dblink->getStringForQuery($storeCode);
        $userId = $dblink->getStringForQuery($userId);
        
		$query = "INSERT INTO ".self::$tableName." SET
				referralId = '".$referralId."' ,
				referringId = '".$referringId."',
				accountNumber = '".$accountNumber."',
				phoneNumber = '".$phoneNumber."',
				storeCode = '".$storeCode."',
				status = 'requested' ,
				userId = ".$userId."";
		
		$dblink->query($query);	
	}

    public function isRequested(){
        return $this->status == 'requested';
    }
	
	//---- Admin menu ----
	public static function getAll($requestedOnly){
		//Setting
        $dblink = new DBLink();
        
        //Make query
		$query = "SELECT id FROM ".self::$tableName;
        if($requestedOnly){
            $query .= " WHERE status = 'requested'";
        }
        
		$result = $dblink->query($query);
        if($dblink->isEmpty()){
            return null;
        }
		//Array variable for return;
		$return;
		while($row = mysqli_fetch_assoc($result)){
			$instance = new self();
            $instance->loadById($row['id']);
			$return[] = $instance;
		}
		return $return;
	}
	
	public function updateStatus( $status, $comment, $user){
        $dblink = new DBLink();

        $comment = $dblink->getStringForQuery($comment);
        
		//Status can be approved or declined
		$query = "UPDATE ".self::$tableName." SET
					comment = '".$dblink->convertStringForComment($comment,$user->getFullName($user->id))."',
					status = '".$status."' ,
					adminId = ".$user->id."
					WHERE id = ".$this->id.";";
		$dblink->query($query);
	}
}
?>