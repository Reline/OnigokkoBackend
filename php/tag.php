<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';
	
    // check required fields
    if(!$_PUT['Tagged'] || !$_PUT['GameID']) {
        die('Error: Check required fields');
    }
    
    connectToDB();

    $tagged_id = $mysqli->real_escape_string($_PUT['Tagged']);
    $game_id = $mysqli->real_escape_string($_PUT['GameID']);
    $date = date("Y-m-d h:i:s");

    $sql = "UPDATE Player_Game SET It = '0', LastTagged = '$date' WHERE It = '1' AND GameID = '$game_id';";
    $sql .= "UPDATE Player_Game SET It = '1' WHERE PlayerGoogleID = '$tagged_id' AND GameID = '$game_id'";
    if ($mysqli->multi_query($sql) === TRUE) {
        echo "Records updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
