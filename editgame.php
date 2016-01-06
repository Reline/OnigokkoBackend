<?php
header("Content-Type: text/html; charset=utf-8");
include 'common.php';
    if($_POST) {
        
        // check for required fields
        if(!$_POST['ID'] || !$_POST['Name'] || !$_POST['GameType'] || !$_POST['MinimumTagDistance'] || $_POST['MinimumHintDistance'] || $_POST['ImmunityTime'] || $_POST['It']) {
            echo "Check required fields";
            exit();
        }
        
        //connect to DB
        connectToDB();
        
        //get input & clean them
        $safe_id = mysqli_real_escape_string($mysqli, $_POST['ID']);
        $safe_name = mysqli_real_escape_string($mysqli, $_POST['Name']);
        $safe_type = mysqli_real_escape_string($mysqli, $_POST['GameType']);
        $safe_tag_distance = mysqli_real_escape_string($mysqli, $_POST['MinimumTagDistance']);
        $safe_hint_distance = mysqli_real_escape_string($mysqli, $_POST['MinimumHintDistance']);
        $safe_immunity_time = mysqli_real_escape_string($mysqli, $_POST['ImmunityTime']);
        $safe_it = mysqli_real_escape_string($mysqli, $_POST['It']);
           
        // update
        $edit_game_query = "UPDATE Game SET Name = '" . $safe_name . "', GameType = '" . $safe_type . "', MinimumTagDistance = '" . $safe_tag_distance . "', MinimumHintDistance = '" . $safe_hint_distance . "', ImmunityTime = '" . $safe_immunity_time . "', It = '" . $safe_it . "' WHERE ID = " . $safe_id;
	echo $edit_game_query . "<br>";
        $edit_game_response = mysqli_query($mysqli, $edit_game_query) or die(mysqli_error($mysqli));

        mysqli_free_result($edit_game_response);
        mysqli_close($mysqli);
    }
?>
