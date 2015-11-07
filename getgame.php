<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// connect to the database
	connectToDB();

	// clean our request
	$safe_game_id = mysqli_real_escape_string($mysqli, $_GET['ID']);
 
        $get_game_query = "SELECT ID, Name, GameType, MinimumTagDistance, MinimumHintDistance, ImmunityTime FROM Game WHERE ID = " . $safe_game_id;
        $get_game_response = mysqli_query($mysqli, $get_game_query) or die(mysqli_error($mysqli));
 
        $gamedata = "";
        $row = mysqli_fetch_assoc($get_game_response);
        $gamedata .= json_encode($row);
 
        echo $gamedata;
 
        mysqli_free_result($get_game_response);
        mysqli_close($mysqli);
?>
