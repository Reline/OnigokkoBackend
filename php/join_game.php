<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';

    // check for required fields
    if(!$_POST['GameID'] || !$_POST['PlayerGoogleID']) {
        die('Error: Check required fields');
    }

    connectToDB();
    
    $game_id = $mysqli->real_escape_string($_POST['GameID']);
    $google_id = $mysqli->real_escape_string($_POST['PlayerGoogleID']);

    $sql = "INSERT INTO Player_Game (GameID, PlayerGoogleID) values ('$game_id', '$google_id')";
    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
