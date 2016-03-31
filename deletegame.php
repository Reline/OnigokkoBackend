<?php
header("Content-Type: text/html; charset=utf-8");
include 'common.php';
    if($_POST) {
        
        // check for required fields
        if(!$_POST['ID']) {
            echo "Check required fields";
            exit();
        }
        
        //connect to DB
        connectToDB();
        
        //get input & clean them
        $safe_id = mysqli_real_escape_string($mysqli, $_POST['ID']);
       
	// delete players from bridge table
	$delete_players_query = "DELETE FROM Player_Game WHERE GameID = " . $safe_id;
	$delete_players_response = mysqli_query($mysqli, $delete_players_query) or die(mysqli_error($mysqli));

	mysqli_free_result($delete_players_response);
 
	// delete game   
        $delete_game_query = "DELETE FROM Game WHERE ID = " . $safe_id;
        $delete_game_response = mysqli_query($mysqli, $delete_game_query) or die(mysqli_error($mysqli));

        mysqli_free_result($delete_game_response);
        mysqli_close($mysqli);
    }
?>
