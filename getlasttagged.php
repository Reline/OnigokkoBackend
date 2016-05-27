<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';

	// check for required fields
    if(!$_GET['GameID'] || !$_GET['PlayerGoogleID']) {
        echo "Check required fields.";
        exit();
    }

	connectToDB();

	$safe_game_id = mysqli_real_escape_string($mysqli, $_GET['GameID']);
	$safe_player_id = mysqli_real_escape_string($mysqli, $_GET['PlayerGoogleID']);

	$get_lasttagged_query = "SELECT LastTagged FROM Player_Game WHERE GameID = '$safe_game_id' AND PlayerGoogleID = '$safe_player_id'";
	$get_lasttagged_response = mysqli_query($mysqli, $get_lasttagged_query) or die(mysqli_error($mysqli));

	$player = mysqli_fetch_assoc($get_lasttagged_response);
	$data = json_encode($player);

	echo $data;
	
	mysqli_free_result($get_lasttagged_response);
	mysqli_close($mysqli);
?>
