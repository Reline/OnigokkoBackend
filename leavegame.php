<?php
	header('Content-Type: text/html; charset=utf-8');
	include 'common.php';
	
	if($_POST) {
		// check required fields
		if(!$_POST['GameID'] || !$_POST['PlayerGoogleID']) {
			echo "Check required fields.";
			exit();
		}		

		connectToDB();
	
		$safe_game_id = mysqli_real_escape_string($mysqli, $_POST['GameID']);
		$safe_player_google_id = mysqli_real_escape_string($mysqli, $_POST['PlayerGoogleID']);
		
		$query = "DELETE FROM Player_Game WHERE GameID = '$safe_game_id' AND PlayerGoogleID = '$safe_player_google_id'";
		$query_response = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));

		$mysqli_free_result($query_response);
		$mysqli_close($mysqli);
	}
?>
