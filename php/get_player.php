<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// check for required fields
    if(!$_GET['GoogleID']) {
        die('Error: Check required fields');
    }

    // open connection to database
	connectToDB();

    // get input and clean them
	$google_id = $mysqli->real_escape_string($_GET['GoogleID']);

	$sql = "SELECT * FROM Player WHERE GoogleID = '$google_id'";
	$result = $mysqli->query($sql);

	$row = $result->fetch_assoc();
	echo json_encode($row);

	$mysqli->close();
?>
