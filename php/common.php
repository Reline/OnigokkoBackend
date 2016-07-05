<?php
	function connectToDB() {	
		global $servername;
		global $username;
		global $password;
		global $database;
		global $mysqli;
		
		$servername  = 'localhost';
		$username = 'root';
		$password = 'mysql';
		$database = 'tag';
		
		// create connection
		$mysqli = new mysqli($servername, $username, $password, $database);
		
		// check connection
		if($mysqli->connect_error) {
			die("Connection failed: " . $mysqli->connect_error);
		}
		// echo "Connected successfully
	}

?>
