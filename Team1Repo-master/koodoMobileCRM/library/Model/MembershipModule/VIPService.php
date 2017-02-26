<?php
include_once("../library/DBLink.php");

class VIPService
{
    private static $tableName = "VIPService";

    private $id;
    private $title;
    private $description;

    //Magic Method
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    //--- Protected method
    protected function loadById($id)
    {
        $dblink = new DBLink();
        $query = "SELECT * FROM " . self::$tableName . " WHERE id = " . $id . ";";
        $result = $dblink->query($query);
        $row = mysqli_fetch_assoc($result);
        $this->fill($row);
    }

    protected function fill($row)
    {
        if (is_array($row)) {
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->description = $row['description'];
        }
    }

    public static function serviceWithId($id){
        $instance = new self();
        $instance->loadById($id);
        return $instance->title;

    }

    public static function getAll()
    {
        //Setting
        $dblink = new DBLink();


        //Make query
        $query = "SELECT * FROM " . self::$tableName;

        $result = $dblink->query($query);

        //Array variable for return;
        $return;
        while ($row = mysqli_fetch_assoc($result)) {
            $instance = new self();
            $instance->fill($row);
            $return[] = $instance;
        }
        return $return;
    }

}
?>