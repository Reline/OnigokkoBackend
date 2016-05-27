<?php
	header("Content-Type: text/html; charset=utf-8");
	include 'common.php';

	if($_POST) {
		// check for our required fields
		if(!$_POST['Name']) {
			echo "Name field is required.";
			exit();
		} elseif (!$_POST['GoogleID']) {
			echo "GoogleID field is required."
			exit();
		}
		
		// connect to the database
		connectToDB();
	
		// get input and clean them
		$safe_name = mysqli_real_escape_string($mysqli, $_POST['Name']);
		$safe_google_id = mysqli_real_escape_string($mysqli, $_POST['GoogleID']);
		$safe_latitude = mysqli_real_escape_string($mysqli, $_POST['Latitude']);
		$safe_longitude = mysqli_real_escape_string($mysqli, $_POST['Longitude']);

		if (!$_POST['Latitude'] || !$_POST['Longitude']) {
			$safe_latitude = 0.0;
			$safe_longitude = 0.0;
		}
		
		// insert user into database
		$add_player_query = "INSERT INTO Player (Name, Latitude, Longitude, GoogleID) values ('$safe_name', '$safe_latitude', '$safe_longitude', '$safe_google_id')";
		$add_player_response = mysqli_query($mysqli, $add_player_query) or die(mysqli_error($mysqli));

		mysqli_free_result($add_player_response);
		mysqli_close($mysqli);
	}
?>
