<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';
	
    // check for required fields
    if(!$_POST['Name'] || !$_POST['MinimumTagDistance'] || !$_POST['MinimumHintDistance'] || !$_POST['ImmunityTime']) {
        die('Error: Check required fields');
    }

    // open connection to database
    connectToDB();

    // get input and clean them
    $name = $mysqli->real_escape_string($_POST['Name']);
    $type = $mysqli->real_escape_string($_POST['GameType']);
    $tag_distance = $mysqli->real_escape_string($_POST['MinimumTagDistance']);
    $hint_distance = $mysqli->real_escape_string($_POST['MinimumHintDistance']);
    $immunity_time = $mysqli->real_escape_string($_POST['ImmunityTime']);
    $google_id = $mysqli->real_escape_string($_POST['PlayerGoogleID']);

    // insert game into database
    $sql = "INSERT INTO Game (Name, GameType, MinimumTagDistance, MinimumHintDistance, ImmunityTime, Owner) VALUES ('$name', '$type', '$tag_distance', '$hint_distance', '$immunity_time', '$google_id')";
    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // get game id
    $game_id = $mysqli->insert_id;;
    // relate player and game in bridge table
    $sql_bridge = "INSERT INTO Player_Game (GameID, PlayerGoogleID) values ('$game_id', '$google_id')";
    if ($mysqli->query($sql_bridge) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql_bridge . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
