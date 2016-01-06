<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// start that sucker up
	connectToDB();

	// bust the clorox out
	$safe_game_id = mysqli_real_escape_string($mysqli, $_GET['GameID']);

	// get players in a certain game
	$get_players_query = "SELECT * FROM Player WHERE GoogleID = (SELECT GoogleID FROM Player_Game WHERE GameID = " . $safe_game_id . ")";
	$get_players_response = mysqli_query($mysqli, $get_players_query) or die(mysqli_error($mysqli));

	// JSONArray
	$playerdata = '[';
	while($row = mysqli_fetch_assoc($get_players_response)) {
		$playerdata .= json_encode($row);
		$playerdata .= ",";
	}
	mysqli_free_result($get_players_response);
	mysqli_close($mysqli);
	$playerdata = trim($playerdata, ",");
	$playerdata .= "]";

	echo $playerdata;
?>
