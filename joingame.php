<?php
	header("Content-Type: text/html; charset=utf08");
	include 'common.php';

	if($_POST) {
		// check for required fields

		connectToDB();
		$safe_game_id = mysqli_real_escape_string($mysqli, $_POST['GameID']);
		$safe_player_google_id = mysqli_real_escape_string($mysqli, $_POST['PlayerGoogleID']);

		$query = "INSERT INTO Player_Game (GameID, PlayerGoogleID) values ('" . $safe_game_id . "', '" . $safe_player_google_id . "')";
		echo "$query";
		$query_response = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		mysqli_free_result($query_response);
		mysqli_close($mysqli);
	}
?>
