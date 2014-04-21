<?php

session_start();

// retrieve post variables
$tag = $_POST['tagID'];
$desc = $_POST['description'];
$action = $_POST['action'];

echo "Action: " . $action . "<br>";
echo "Tag: " . $tag . "<br>";
echo "Description: " . htmlspecialchars($desc) . "<br>";
echo "Username: " . $_SESSION['username'] . "<br>";

// $action == create OR $action == delete
if($action == 'create'){
	// do SQL query to add the tag to DB

	// Connect to DB:
	$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
	if (mysqli_connect_errno() ){
		echo "Failed to connect to mysqli: " . mysqli_connect_error();
	}

	// retrieve customer's ID to use in the DB
	$username = $_SESSION['username'];	// I believe this variable has already been sanitized from login.php...
	$username = mysqli_real_escape_string($conn, $username);
	$desc = mysqli_real_escape_string($conn, $desc);
	// $query = "SELECT * FROM member WHERE username = '$username';";
	// $result = mysqli_query($conn, $query);

	$query = "SELECT id FROM member WHERE username = '$username';";

	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Could not run query.";
		mysqli_close($conn);
		echo "\n DB connection closed.";
		exit;
	}
	$row = mysqli_fetch_row($result);
	$customerID = $row[0]; // returns customer ID

	// insert into tag table
	$insertquery = "INSERT INTO tag_id (user_id, tag_id, description) VALUES ('$customerID','$tag','$desc');";
	header('Location: http://149.166.29.173/sales_side/tag.php');
	mysqli_query($conn, $insertquery);
	mysqli_close($conn);
}

if($action == 'delete'){
	// do SQL query to remove from the DB using POST variables

	// Connect to DB:
	$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
	if (mysqli_connect_errno() ){
		echo "Failed to connect to mysqli: " . mysqli_connect_error();
	}

	// query tag_id table to find rows that match the tag_id from the checkbox_tag_array
	if(!empty($_POST['checkbox_tag_array'])){
		foreach($_POST['checkbox_tag_array'] as $checkbox_tags){
			$checkbox_tags = mysqli_real_escape_string($conn, $checkbox_tags);

			$deletequery = "DELETE FROM tag_id WHERE tag_id='$checkbox_tags';";
			$result = mysqli_query($conn, $deletequery);
			if(!$result){
				echo "Could not run query.";
				mysqli_close($conn);
				echo "<br> DB connection closed.";
				exit;
			}
			header('Location: http://149.166.29.173/sales_side/tag.php');
			mysqli_close($conn);
			// echo "This tag was checked: " . $checkbox_tags . "<br>";
		}
	} else {
		header('Location: http://149.166.29.173/sales_side/management.php?action=delete');
	}
}

// if $action == 'edit'....

// redirect back to tag.php if no action specified
header('Location: management.php')

?>