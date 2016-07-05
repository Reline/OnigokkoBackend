<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';

    // check for required fields
    if(!$_POST['Name'] || !$_POST['GoogleID']) {
        die('Error: Check required fields');
    }

    // open connection to database
    connectToDB();

    // get input and clean them
    $name = $mysqli->real_escape_string($_POST['Name']);
    $google_id = $mysqli->real_escape_string($_POST['GoogleID']);
    $latitude = $mysqli->real_escape_string($_POST['Latitude']);
    $longitude = $mysqli->real_escape_string($_POST['Longitude']);

    if (!$_POST['Latitude'] || !$_POST['Longitude']) {
        $latitude = 0.0;
        $longitude = 0.0;
    }

    // insert user into database
    $sql = "INSERT INTO Player (Name, Latitude, Longitude, GoogleID) values ('$name', '$latitude', '$longitude', '$google_id')";
    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();

?>
