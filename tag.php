<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';
	
	if($_POST) {
		
		connectToDB();

		$safe_old_id = mysqli_real_escape_string($mysqli, $_POST['Old']);
		$safe_new_id = mysqli_real_escape_string($mysqli, $_POST['New']);
		$safe_game_id = mysqli_real_escape_string($mysqli, $_POST['GameID']);
		$safe_date = mysqli_real_escape_string($mysqli, $_POST['Date']);

		$query = "UPDATE Player_Game SET It = '0' WHERE PlayerGoogleID = '" . $safe_old_id . "' AND GameID = '" . $safe_game_id . "'; UPDATE Player_Game SET It = '1', LastTagged = '" . $safe_date . "' WHERE PlayerGoogleID = '" . $safe_new_id . "' AND GameID = '" . $safe_game_id . "';";
		$response = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
		
		mysqli_free_result($response);
		mysqli_close($mysqli);
	}
?>
