<?php
class DBController {
	private $host = "127.0.0.1";
	private $user = "root";
	private $password = "88";
	private $database = "bookstore";
	private $db;
	
	function __construct() {
		$this->db = $this->connectDB();
	}
	
	function connectDB() {
		$db = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $db;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->db,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->db,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>