<?php
    header("Content-Type: text/html; charset=utf-8");
    include 'common.php';

    if($_POST) {
        
        // check for required fields; only the longitude and latitude can be changed, googleid used as identifier
        if(!$_POST['Latitude'] || !$_POST['Longitude'] || !$_POST['GoogleID']) {
            echo "Check required fields";
            exit();
        }
        
        //connect to DB
        connectToDB();
        
        //get input & clean them
        $safe_latitude = mysqli_real_escape_string($mysqli, $_POST['Latitude']);
        $safe_longitude = mysqli_real_escape_string($mysqli, $_POST['Longitude']);
        $safe_google_id = mysqli_real_escape_string($mysqli, $_POST['GoogleID']);
           
        // update
        $edit_player_query = "UPDATE Player SET Latitude = '$safe_latitude', Longitude = '$safe_longitude' WHERE GoogleID = '$safe_google_id'";
        $edit_player_response = mysqli_query($mysqli, $edit_player_query) or die(mysqli_error($mysqli));

        mysqli_free_result($edit_player_response);
        mysqli_close($mysqli);
    }
?>
