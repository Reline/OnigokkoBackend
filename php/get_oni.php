<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	// check required fields
	if(!$_GET['GameID']) {
        die('Error: Check required fields.');
	}

	connectToDB();
	
	$game_id = $mysqli->real_escape_string($_GET['GameID']);

	$sql = "SELECT DISTINCT Player.GoogleID FROM Player JOIN Player_Game WHERE Player_Game.It = 1 AND Player.GoogleID = Player_Game.PlayerGoogleID AND Player_Game.GameID = '$game_id'";
	$result = $mysqli->query($sql);

	$row = $result->fetch_assoc();
	echo json_encode($row);

	$mysqli->close();
?>
