<?php
include_once("../library/DBLink.php");

class Membership{
    private static $tableName = "membership";
    
	//Private Properties
	private $balance;
	private $customerId;
	private $id;
	private $startDate;
	private $VIPStartDate;
    private $emailPassword;

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
            $this->balance = $row['balance'];
            $this->id = $row['id'];
            $this->customerId = $row['customerId'];
            $this->startDate = $row['startDate'];
            $this->emailPassword = $row['emailPassword'];
            $this->VIPStartDate = $row['VIPStartDate'];
        }
    }


    
    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
    
	public static function addNew($customerId, $membershipId, $emailPassword){
        $dblink = new DBLink();
        
        //Get string safe for sql
        $customerId = $dblink->getStringForQuery($customerId);
        $membershipId = $dblink->getStringForQuery($membershipId);
        $emailPassword = $dblink->getStringForQuery($emailPassword);
        
		//Insert New Member	
		$query = "INSERT INTO ".self::$tableName." SET
					customerId = ".$customerId.",
					emailPassword = '".$emailPassword."',
					id = ".$membershipId.";";
		$dblink->query($query);
	
		//Return Membership Id
		return $membershipId;
	}
    
    public static function isExist($id){
        $dblink = new DBLink();
        $query = "SELECT * FROM ".self::$tableName." WHERE id = ".$id.";";
		
		$dblink->query($query);
        if($dblink->isEmpty()){
            return false;
        }
        return true;
        
    }


    public static function isValidHash($membershipId, $hash){
        if(md5($membershipId."userId") === $hash){
            return true;
        }
        return false;
    }

	
    //---- special methods
    public function redirectString(){
        //Later.. UserId..
        return "membershipId=".$this->id."&hash=".md5($this->id."userId");
    }

	public function isVIP(){
		if($this->VIPStartDate != null)
			return true;
		return false;
	}
    
    public function updateBalance($balance, $type){
        $dblink = new DBLink();
        $newBalance = 0;
        if($type == "+"){
            $newBalance = $this->balance + $balance;
        }else if($type == "-"){
            $newBalance = $this->balance - $balance;
        }else{
            //Error Handling from Code
            print ("updateBalance operation type is not set!");
            exit();
        } 
        
		$query = "Update ".self::$tableName." SET
					balance = ".$newBalance."
                    WHERE id = ".$this->id.";";
        $dblink->query($query);
    }
	
	public function activateVIP(){
        $dblink = new DBLink();
		$query = "Update ".self::$tableName." SET
					VIPStartDate = '".date ("Y-m-d H:i:s")."'
                    WHERE id = ".$this->id.";";
		
		$dblink->query($query);
	}
	
	//---- Admin Methods ---------------------
    
    //-- Get All of Objects
	public static function getAll(){
        //Setting
        $dblink = new DBLink();
        
        
        //Make query
		$query = "SELECT * FROM ".self::$tableName."
		            WHERE VIPStartDate is not null ORDER BY VIPStartDate;";
     
		$result = $dblink->query($query);
        
        //Array variable for return;
		$return;
		while($row = mysqli_fetch_assoc($result)){
			$instance = new self();
            $instance->fill($row);
			$return[] = $instance;
		}
		return $return;
	}

    public static function getAllWith($date){
        //Setting
        $dblink = new DBLink();

        //Make query
        $query = "SELECT * FROM ".self::$tableName."
		            WHERE VIPStartDate is not null AND VIPStartDate <= '".$date."' ORDER BY VIPStartDate;";

        $result = $dblink->query($query);

        //Array variable for return;
        $return = "";
        while($row = mysqli_fetch_assoc($result)){
            $instance = new self();
            $instance->fill($row);
            $return[] = $instance;
        }
        return $return;
    }
	
    //---- special methods
	public function deactivateVIP(){
        $dblink = new DBLink();
        $query = "Update ".self::$tableName." SET
					VIPStartDate = null
                    WHERE id = '".$this->id."';";
		$dblink->query($query);
	}
	
}