<?php
include_once("../library/DBLink.php");

class KoodoService {
	private static $tableName = "koodoservice";
	
	// Table columns
	private $id;
    private $phoneNumber;
    private $imeiNumber;
    private $simNumber;
    private $giftCardUsed;
    private $plan;
    private $addOn;
    private $tab;
    private $modelCode;
    private $koodoAccountId;
    private $saleStatus;
    
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
            $this->phoneNumber = $row['phoneNumber'];
            $this->id = $row['id'];
            $this->imeiNumber = $row['imeiNumber'];
            $this->simNumber = $row['simNumber'];
            $this->giftCardUsed = $row['giftCardUsed'];
            $this->plan = $row['plan'];
            $this->addOn = $row['addOn'];
            $this->tab = $row['tab'];
            $this->modelCode = $row['modelCode'];
            $this->koodoAccountId = $row['koodoAccountId'];
            $this->saleStatus = $row['saleStatus'];
        }
    }
    
    //Update KoodoService
	public function update($phoneNumber, $imeiNumber, $simNumber, $giftCardUsed, 
    $plan, $addOn, $tab, $modelCode, $saleStatus) {
        $dblink = new DBLink();
        
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        $imeiNumber = $dblink->getStringForQuery($imeiNumber);
        $simNumber = $dblink->getStringForQuery($simNumber);
        $giftCardUsed = $dblink->getStringForQuery($giftCardUsed);
        $plan = $dblink->getStringForQuery($plan);
        $addOn = $dblink->getStringForQuery($addOn);
        $tab = $dblink->getStringForQuery($tab);
        $modelCode = $dblink->getStringForQuery($modelCode);
        $saleStatus = $dblink->getStringForQuery($saleStatus);
        
		//Insert New Koodo Service	
		$query = "UPDATE ".self::$tableName." SET
					phoneNumber = ".$phoneNumber.",
					imeiNumber = '".$imeiNumber."',
					simNumber = '".$simNumber."',
					giftCardUsed = '".$giftCardUsed."',
					plan = ".$plan.",
					addOn = '".$addOn."',
					tab = '".$tab."',
					modelCode = '".$modelCode."',
                    saleStatus = '".$saleStatus."'
                    WHERE id = ".$this->id.";";
                    
		$dblink->query($query);
	}
    
    // Update KoodoService
	public function updateSaleStatus($saleStatus) {
        $dblink = new DBLink();
        $saleStatus = $dblink->getStringForQuery($saleStatus);
        
		// Update sale status for a Koodo Service	
		$query = "UPDATE ".self::$tableName." SET
		            saleStatus = '".$saleStatus."'
                    WHERE id = ".$this->id.";";
                    
		$dblink->query($query);
	}
    
    // -- Static functions --
        
    public static function withId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance;
    }
    
    //Add new Koodo Service return koodoServiceId
	public static function addNew($phoneNumber, $imeiNumber, 
    $simNumber, $giftCardUsed, $plan, $addOn, $tab, $modelCode, 
    $koodoAccountId, $saleStatus) {
        $dblink = new DBLink();
        
        $phoneNumber = $dblink->getStringForQuery($phoneNumber);
        $imeiNumber = $dblink->getStringForQuery($imeiNumber);
        $simNumber = $dblink->getStringForQuery($simNumber);
        $giftCardUsed = $dblink->getStringForQuery($giftCardUsed);
        $plan = $dblink->getStringForQuery($plan);
        $addOn = $dblink->getStringForQuery($addOn);
        $tab = $dblink->getStringForQuery($tab);
        $modelCode = $dblink->getStringForQuery($modelCode);
        $koodoAccountId = $dblink->getStringForQuery($koodoAccountId);
        $saleStatus = $dblink->getStringForQuery($saleStatus);
        
		//Insert New Koodo Service	
		$query = "INSERT INTO ".self::$tableName." SET
					phoneNumber = ".$phoneNumber.",
					imeiNumber = '".$imeiNumber."',
					simNumber = '".$simNumber."',
					giftCardUsed = '".$giftCardUsed."',
					plan = ".$plan.",
					addOn = '".$addOn."',
					tab = '".$tab."',
					modelCode = '".$modelCode."',
                    saleStatus = '".$saleStatus."',
                    koodoAccountId = '".$koodoAccountId."'
                    ;";
                    
		$dblink->query($query);
		$koodoServiceId = $dblink->getLastInsertedId();
        
		//Return koodoService Id
		return $koodoServiceId;
	}
}
?>