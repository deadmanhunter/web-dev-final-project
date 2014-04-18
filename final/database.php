<?php

class Database {
	
	protected $db;
	protected $num;
	public $result;
	var $query;
	
	function __construct() {
		
		global $host, $user, $pass, $name;
		
		$this->dbhost = $host;
		$this->dbuser = $user;
		$this->dbpass = $pass;
		$this->dbname = $name;
		$this->db_open();
	}
	
	protected function db_open() {
		
		$this->db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		
		if (empty($this->db)) {
			
			error('DATABASE CONNECTION FAILED.', MYSQL_ERROR);
			
		}
		else {
			
			return $this->db;
			
		}
		
	}
	
	public function sql_query($query) {
		
		if (isset($query)) {
		
				$result = mysqli_query($this->db, $query) or die("Error: ".mysqli_error($this->db));
		
				if (!isset($result)) {

					die("Query connection failed: " . mysqli_error($this->db)); // Change this to whatever you want
			
				}
				else {
						
					return $result;
				
				}
				
		}
		else {
					
			// Your error message here: "Query was empty".
			
		}
		
	}
	
	public function fetch_object($obj) {
		
		return mysqli_fetch_object($obj);
		
	}
	
	public function num_rows($num) {
		
		return mysqli_num_rows($num);
		
	}
	
	function db_close($db) {
		
		if (isset($db)) {
			
			mysqli_close($db);
			unset($db);
			
		}
		
	}
	
} // end db class

?>
