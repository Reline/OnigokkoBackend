<?php
	header("Content-Type: application/json; charset=utf-8");
	include 'common.php';
	
	// connect to the database
	connectToDB();

	// clean our request
	$safe_game_id = mysqli_real_escape_string($mysqli, $_GET['ID']);
        // use the player's google id to return the lasttagged datetime value from the player_game bridge table
        // $safe_google_id = mysqli_real_escape_string($mysqli, $_GET['PlayerGoogleID']);
 
        $get_game_query = "SELECT * FROM Game WHERE ID = " . $safe_game_id;
	// echo "$get_game_query";
        $get_game_response = mysqli_query($mysqli, $get_game_query) or die(mysqli_error($mysqli));
 
        // $get_lasttagged_query = "SELECT LastTagged FROM Player_Game WHERE ID = " . $safe_game_id . " AND PlayerGoogleID = " . $safe_google_id;
        // $get_lasttagged_response = mysqli_query($mysqli, $get_lasttagged_query) or die(mysqli_error($mysqli));

        $gamedata = "";
        $row = mysqli_fetch_assoc($get_game_response);
        $gamedata .= json_encode($row);
        // i wonder how this will turn out...
        // $row = mysqli_fetch_assoc($get_lasttagged_response);
        //$gamedata .= json_encode($row);
 
        echo $gamedata;
 
        mysqli_free_result($get_game_response);
	// mysqli_free_result($get_lasttagged_response);
        mysqli_close($mysqli);
?>
