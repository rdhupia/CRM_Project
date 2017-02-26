<?php
  class DBLink {
 
     private $link;
     private $result;

	 function __construct () {
	     // get database servername, username, password, and database name
         $lines = file('../../dbinfo.txt');
	     $dbserver = trim($lines[0]);
	     $uid = trim($lines[1]);
	     $pw = trim($lines[2]);
	     $dbname = trim($lines[3]);
 
         //Connect to the mysql server and get back our link_identifier
         $link = mysqli_connect($dbserver, $uid, $pw, $dbname)
         			or die('Could not connect: ' . mysqli_error($link));
         $this->link = $link;
     }

     function query ($sql_query) {
         $result = mysqli_query($this->link, $sql_query) or die('Query Failed: <br>'.$sql_query." <br>". mysqli_error($this->link));//Run our sql query
		 $this->result = $result;
         return $result;
     }
     
     function getLastInsertedId(){
         return $this->link->insert_id;
     }
	 
	 function isEmpty()  {
	     $records = mysqli_num_rows ($this->result);
         if($records == 0)
            return true;
        return false;
	 }
	 
	 function getStringForQuery( $str )    {
		 return  mysqli_real_escape_string($this->link, $str);
	 }
	 
	 function convertStringForComment($str, $userName){
	 	$prefix = "Updated on ".date ("Y-m-d", $phptime)."by ".$userName.":<br>";
		return $prefix + $str;
	 }
	 
     //What is this do?
	 function freeResult()    {
	     mysqli_free_result($this->result);  
	 }
	 
     function __destruct() {          
         mysqli_close($this->link);
     }
  }
?>