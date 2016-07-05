<?php
    header("Content-Type: text/html; charset=utf-8");
    include 'common.php';
    
    // check for required fields
    if(!$_DELETE['ID']) {
        die('Error: Check required fields');
    }

    //connect to DB
    connectToDB();

    //get input & clean
    $game_id = $mysqli->real_escape_string($_POST['ID']);

    // delete related players from bridge table and game
    $sql = "DELETE FROM Player_Game WHERE GameID = '$game_id';";
    $sql .= "DELETE FROM Game WHERE ID = '$game_id'";
    if ($mysqli->multi_query($sql) === TRUE) {
        echo "Records deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
?>
