<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	connectToDB();

	$safe_google_id = mysqli_real_escape_string($mysqli, $_GET['PlayerGoogleID']);

	$get_games_query = "SELECT DISTINCT Game.* FROM Game JOIN Player_Game WHERE Player_Game.PlayerGoogleID = " . $safe_google_id;
	$get_games_response = mysqli_query($mysqli, $get_games_query) or die(mysqli_error($mysqli));

	$gamedata = '[';
	while($row = mysqli_fetch_assoc($get_games_response)) {
		$gamedata .= json_encode($row) . ",";
	}
	
	$gamedata = trim($gamedata, ",");
	$gamedata .= "]";
	echo $gamedata;

	mysqli_free_result($get_games_response);
	mysqli_close($mysqli);
?>
