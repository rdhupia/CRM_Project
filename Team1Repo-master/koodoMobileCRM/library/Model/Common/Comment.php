<?php
include_once("../library/DBLink.php");

class Comment{
    private static $tableName = "comment";
    
	//Private Properties
	private $id;
	private $userId;
	private $saleId;
	private $timestamp;
    private $context;

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
            $this->context = $row['context'];
            $this->userId = $row['userId'];
            $this->saleId = $row['saleId'];
            $this->timestamp = $row['timestamp'];
        }
    }

    //Add new Comment and return commentId
	public static function addNew($context, $userId, $saleId){
        $dblink = new DBLink();
        
        $context = $dblink->getStringForQuery($context);
        $userId = $dblink->getStringForQuery($userId);
        $saleId = $dblink->getStringForQuery($saleId);
        
		//Insert New Comment	
		$query = "INSERT INTO ".self::$tableName." SET
					saleId = ".$saleId.",
					context = '".$context."',
					userId = '".$userId."';";
                    
		$dblink->query($query);
		$commentId = $dblink->getLastInsertedId();
        
		//Return commentId
		return $commentId;
	}

    //public static methods
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
    
    public static function getCommentForSale($saleId) {
        $dblink = new DBLink();
        $query = "SELECT timestamp, context FROM ".self::$tableName." WHERE saleId = '".$saleId."';";
        $result = $dblink->query($query);
        $text = "";
        while($row = mysqli_fetch_assoc($result))
        {
            $dateStr = date('Y-m-d H:i', strtotime($row['timestamp']));
            $text .= $dateStr."-".$row['context']."; ";
        }
        return $text;
    }
}
?>