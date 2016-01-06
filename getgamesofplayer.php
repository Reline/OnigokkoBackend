<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php'

	// connect to database
	connectToDB();

	// clean up request
	$safe_google_id = mysqli_real_escape_string($mysqli, $_GET['PlayerGoogleID']);

	// get every game that our player is participating in
	$get_games_query = "SELECT * FROM Game WHERE GameID = (SELECT GameID FROM Player_Game WHERE Player = " . $safe_google_id . ")";
	echo $get_games_query . "<br>";
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
