<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	// check for required fields
    if(!$_GET['GameID'] || !$_GET['PlayerGoogleID']) {
        die('Error: Check required fields');
    }

	connectToDB();

	$game_id = $mysqli->real_escape_string($_GET['GameID']);
	$player_id = $mysqli->real_escape_string($_GET['PlayerGoogleID']);

	$sql = "SELECT LastTagged FROM Player_Game WHERE GameID = '$game_id' AND PlayerGoogleID = '$player_id'";
	$result = $mysqli->query($sql);

	$row = mysqli_fetch_assoc($result);
	echo json_encode($row);
	
	$mysqli->close();
?>
