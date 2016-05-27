<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	// check required fields
	if(!$_GET['GameID']) {
		echo "GameID field is required.";
		exit();
	}

	connectToDB();
	
	$safe_game_id = mysqli_real_escape_string($mysqli, $_GET['GameID']);

	$get_it_query = "SELECT DISTINCT Player.GoogleID FROM Player JOIN Player_Game WHERE Player_Game.It = 1 AND Player.GoogleID = Player_Game.PlayerGoogleID AND Player_Game.GameID = '$safe_game_id'";
	$get_it_response = mysqli_query($mysqli, $get_it_query) or die(mysqli_error($mysqli));

	$player = mysqli_fetch_assoc($get_it_response);
	$data = json_encode($player);

	echo $data;
	
	mysqli_free_result($get_it_response);
	mysqli_close($mysqli);
?>
