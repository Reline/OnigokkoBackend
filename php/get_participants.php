<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// check for required fields
    if(!$_GET['GameID']) {
        die('Error: Check required fields');
    }

	connectToDB();

	$game_id = $mysqli->real_escape_string($_GET['GameID']);

	// get players in a certain game
	$sql = "SELECT DISTINCT Player.*, Player_Game.It FROM Player JOIN Player_Game WHERE Player_Game.PlayerGoogleID = Player.GoogleID AND Player_Game.GameID = '$game_id'";
	$result = $mysqli->query($sql);

	// place the results into a json array
    $rows = array();
    while($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
    echo json_encode($rows);

    $mysqli->close();
?>
