<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php'

	// connect to database
	connectToDB();

	// clean up request
	$safe_google_id = mysqli_real_escape_string($mysqli, $_GET['PlayerGoogleID']);

	$get_games_query = "SELECT DISTINCT Game.* FROM Game JOIN Player_Game WHERE Player_Game.PlayerGoogleID = " . $safe_google_id . ")";
	$get_games_response = mysqli_query($mysqli, $get_games_query) or die(mysqli_error($mysqli));
	
	// place all of our queried games into an array
	$gamedata = '['; // open our array
	// fill 'er up
	while($row = mysqli_fetch_assoc($get_games_response)) {
		$gamedata .= json_encode($row);
		$gamedata .= ","; // can this be moved up^^ ?
	}
	
	// close up shop!
	mysqli_free_result($get_games_response);
	mysqli_close($mysqli);
	
	$gamedata = trim($userdata, ","); // silly whitespace, scripts are for kids
	$gamedata .= "]"; // close our array
	echo $gamedata;
?>
