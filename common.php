<?php

define("DB_HOST", "localhost");
define("DB_NAME", "tag");
define("DB_USER", "root");
define("DB_PASS", "");

function connectToDB() {
	global $mysqli;

	// connect to server and select database
	// servername, user, pass, dbname
	$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	// if connection fails, stop the script
	if(mysqli_connect_errno()) {
		printf("Connection failed: %s\n", msyqli_connect_error($mysqli));
		exit();
	}
}

?>
