<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';
	
	if($_POST) {
		// check for required fields: Name, GameType, MinimumTagDistance, MinimumHintDistance, ImmunityTime
		if(!$_POST['Name']) { // || !$_POST['GameType'] || !$_POST['MinimumTagDistance'] || $_POST['MinimumHintDistance'] || $_POST['ImmunityTime'] || $_POST['It']) {
			echo "Check required fields";
			exit();
		}

		// connect to the database
		connectToDB();
		
		// get input and clean them
		$safe_name = mysqli_real_escape_string($mysqli, $_POST['Name']);
		$safe_type = mysqli_real_escape_string($mysqli, $_POST['GameType']);
		$safe_tag_distance = mysqli_real_escape_string($mysqli, $_POST['MinimumTagDistance']);
		$safe_hint_distance = mysqli_real_escape_string($mysqli, $_POST['MinimumHintDistance']);
		$safe_immunity_time = mysqli_real_escape_string($mysqli, $_POST['ImmunityTime']);
		$safe_player_id = mysqli_real_escape_string($mysqli, $_POST['PlayerID']);
		// $safe_it = mysqli_real_escape_string($mysqli, $_POST['It']);

		// insert game into database
		$add_game_query = "INSERT INTO Game (Name, GameType, MinimumTagDistance, MinimumHintDistance, ImmunityTime) values ('" . $safe_name . "', '" . $safe_type . "', '" . $safe_tag_distance . "', '" . $safe_hint_distance . "', '" . $safe_immunity_time . "')";
		$add_game_response = mysqli_query($mysqli, $add_game_query) or die(mysqli_error($mysqli));
		
		// get game id
		$game_id = mysqli_insert_id($mysqli);
		
		// echo records added
		echo "Game $game_id added.";

		// $bridge_query = "INSERT INTO Player_Game () values ();"
		// $bridge_response = mysqli_query($msyqli, $bridge_query) or die(mysqli_error($mysqli));

		mysqli_free_result($add_game_response);
		mysqli_close($mysqli);
	}
?>
