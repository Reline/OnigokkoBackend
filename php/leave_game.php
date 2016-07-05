<?php
	header('Content-Type: text/html; charset=utf-8');
	include 'common.php';
	
	if(!$_DELETE['GameID'] || !$_DELETE['PlayerGoogleID']) {
        die('Error: Check required fields');
    }

    connectToDB();
    
    $game_id = $mysqli->real_escape_string($_DELETE['GameID']);
    $google_id = $mysqli->real_escape_string($_DELETE['PlayerGoogleID']);
		
    $sql = "DELETE FROM Player_Game WHERE GameID = '$safe_game_id' AND PlayerGoogleID = '$safe_player_google_id'";
	if ($mysqli->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
