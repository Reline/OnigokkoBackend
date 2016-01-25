<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';
	
	if($_POST) {
		
		connectToDB();

		$safe_old_id = mysqli_real_escape_string($mysqli, $_POST['Old']);
		$safe_new_id = mysqli_real_escape_string($mysqli, $_POST['New']);
		$safe_game_id = mysqli_real_escape_string($mysqli, $_POST['GameID']);
		$safe_date = mysqli_real_escape_string($mysqli, $_POST['Date']);

		$query1 = "UPDATE Player_Game SET It = '0' WHERE PlayerGoogleID = '" . $safe_old_id . "' AND GameID = '" . $safe_game_id . "'";
		$response1 = mysqli_query($mysqli, $query1) or die(mysqli_error($mysqli));

		$query2 = "UPDATE Player_Game SET It = '1', LastTagged = '" . $safe_date . "' WHERE PlayerGoogleID = '" . $safe_new_id . "' AND GameID = '" . $safe_game_id . "'";
		$response2 = mysqli_query($mysqli, $query2) or die(mysqli_error($mysqli));

		mysqli_free_result($response1);
		mysqli_free_result($response2);
		mysqli_close($mysqli);
	}
?>
