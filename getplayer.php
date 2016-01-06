<?php
	header("Content-Type: application/json; charset=utf-8");
	
	include 'common.php';
	
	connectToDB();

	$safe_player_id = mysqli_real_escape_string($mysqli, $_GET['GoogleID']);

	$get_player_query = "SELECT * FROM Player WHERE GoogleID = " . $safe_player_id;
	echo $get_player_query . "<br>";
	$get_player_response = mysqli_query($mysqli, $get_player_query) or die(mysqli_error($mysqli));

	$playerdata = "";
	$row = mysqli_fetch_assoc($get_player_response);
	$playerdata .= json_encode($row);
	
	echo $playerdata;

	mysqli_free_result($get_player_response);
	mysqli_close($mysqli);
?>
