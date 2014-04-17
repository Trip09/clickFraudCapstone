<?php

session_start();
// retrieve post variables
$tag = $_POST['tagID'];
$desc = $_POST['description'];
$action = $_POST['action'];

// $action == create OR $action == delete
if($action == 'create'){
	// do SQL query to add the tag to DB

	// retrieve customer's ID to use in the DB
	$username = $_SESSION['username'];	// I believe this variable has already been sanitized from login.php...
	$username = mysqli_real_escape_string($conn, $username);
	// $query = "SELECT * FROM member WHERE username = '$username';";
	// $result = mysqli_query($conn, $query);

	$query = "SELECT id FROM member WHERE username = '$username';";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Could not run query";
		exit;
	}
	$row = mysqli_fetch_row($result);
	$customerID = $row[0]; // returns customer ID

	// insert into tag table
	$insertquery = "INSERT INTO tags (customerID, tagID, description) VALUES ('$customerID','$tag','$description');";
	mysqli_query($conn, $insertquery);
}

if($action == 'delete'){
	// do SQL query to remove from the DB
}

// redirect back to tag.php
header('Location: tag.php')

?>