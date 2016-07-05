<?php
    header("Content-Type: text/html; charset=utf-8");
    include 'common.php';

    // check for required fields; only the longitude and latitude can be changed, googleid used as identifier
    if(!$_PUT['Latitude'] || !$_PUT['Longitude'] || !$_PUT['GoogleID']) {
        die('Error: Check required fields');
    }
    
    //connect to DB
    connectToDB();
    
    //get input & clean them
    $latitude = $mysqli->real_escape_string($_PUT['Latitude']);
    $longitude = $mysqli->real_escape_string($_PUT['Longitude']);
    $google_id = $mysqli->real_escape_string($_PUT['GoogleID']);
       
    // update
    $sql = "UPDATE Player SET Latitude = '$latitude', Longitude = '$longitude' WHERE GoogleID = '$google_id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
