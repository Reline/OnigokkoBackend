<?php
    header("Content-Type: text/html; charset=utf-8");
    include 'common.php';
 
    // check for required fields
    if(!$_PUT['ID'] || !$_PUT['Name'] || !$_PUT['GameType'] || !$_PUT['MinimumTagDistance'] || $_PUT['MinimumHintDistance'] || $_PUT['ImmunityTime'] || $_PUT['It']) {
        die('Error: Check required fields');
    }
    
    //connect to DB
    connectToDB();
    
    //get input & clean them
    $id = $mysqli->real_escape_string($_PUT['ID']);
    $name = $mysqli->real_escape_string($_PUT['Name']);
    $type = $mysqli->real_escape_string($_PUT['GameType']);
    $tag_distance = $mysqli->real_escape_string($_PUT['MinimumTagDistance']);
    $hint_distance = $mysqli->real_escape_string($_PUT['MinimumHintDistance']);
    $immunity_time = $mysqli->real_escape_string($_PUT['ImmunityTime']);
       
    // update
    $sql = "UPDATE Game SET Name = '$name', GameType = '$type', MinimumTagDistance = '$tag_distance', MinimumHintDistance = '$hint_distance', ImmunityTime = '$immunity_time' WHERE ID = '$id'";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
