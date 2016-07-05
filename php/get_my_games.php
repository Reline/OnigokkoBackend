<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	// check for required fields
    if(!$_GET['PlayerGoogleID']) {
        die('Error: Check required fields');
    }

    // open connection to database
	connectToDB();

	$google_id = $mysqli->real_escape_string($_GET['PlayerGoogleID']);

	$sql = "SELECT DISTINCT Game.* FROM Game JOIN Player_Game WHERE Player_Game.PlayerGoogleID = '$google_id' AND Game.ID = Player_Game.GameID";
	$result = $mysqli->query($sql);

    // place the results into a json array
    $rows = array();
    while($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
    echo json_encode($rows);

    $mysqli->close();
?>
