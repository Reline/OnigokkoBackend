<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// check for required fields
    if(!$_GET['GameID']) {
        echo "GameID field is required.";
        exit();
    }

	connectToDB();

	$safe_game_id = mysqli_real_escape_string($mysqli, $_GET['GameID']);

	// get players in a certain game
	$get_players_query = "SELECT DISTINCT Player.*, Player_Game.It FROM Player JOIN Player_Game WHERE Player_Game.PlayerGoogleID = Player.GoogleID AND Player_Game.GameID = '$safe_game_id'";
	$get_players_response = mysqli_query($mysqli, $get_players_query) or die(mysqli_error($mysqli));

	// JSONArray
	$playerdata = '[';
	while($row = mysqli_fetch_assoc($get_players_response)) {
		$playerdata .= json_encode($row) . ",";
	}
	
	$playerdata = trim($playerdata, ",");
	$playerdata .= "]";
	echo $playerdata;

	mysqli_free_result($get_players_response);
	mysqli_close($mysqli);
?>
