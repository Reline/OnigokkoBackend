<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// check for required fields
    if(!$_GET['GoogleID']) {
        echo "GoogleID field is required.";
        exit();
    }

	connectToDB();

	$safe_player_id = mysqli_real_escape_string($mysqli, $_GET['GoogleID']);

	$get_player_query = "SELECT * FROM Player WHERE GoogleID = '$safe_player_id'";
	$get_player_response = mysqli_query($mysqli, $get_player_query) or die(mysqli_error($mysqli));

	$player = mysqli_fetch_assoc($get_player_response);
	$playerdata = json_encode($player);
	
	echo $playerdata;

	mysqli_free_result($get_player_response);
	mysqli_close($mysqli);
?>
