<?php

session_start();

// retrieve post variables
$action = $_POST['action'];

$tag = $_POST['tagID'];
$desc = $_POST['description'];

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
		$_SESSION['create'] = 'false';
		mysqli_close($conn);
		header('Location: http://149.166.29.173/sales_side/tag.php');
		exit;
	}
	$row = mysqli_fetch_row($result);
	$customerID = $row[0]; // returns customer ID

	// insert into tag table
	$insertquery = "INSERT INTO tag_id (user_id, tag_id, description) VALUES ('$customerID','$tag','$desc');";
	$_SESSION['create'] = 'true';
	header('Location: http://149.166.29.173/sales_side/tag.php');
	mysqli_query($conn, $insertquery);
	mysqli_close($conn);
} else if($action == 'delete'){
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
				$_SESSION['delete'] = 'false';
				mysqli_close($conn);
				header('Location: http://149.166.29.173/sales_side/tag.php');
				exit;
			}
			$_SESSION['delete'] = 'true';
			header('Location: http://149.166.29.173/sales_side/tag.php');
			mysqli_close($conn);
			// echo "This tag was checked: " . $checkbox_tags . "<br>";
		}
	} else {
		$_SESSION['delete'] = 'false';
		mysqli_close($conn);
		header('Location: http://149.166.29.173/sales_side/management.php?action=delete');
	}
} else if($action == 'edit'){

	// Open connection
	$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
	if (mysqli_connect_errno() ){
		echo "Failed to connect to mysqli: " . mysqli_connect_error();
	}

	// Sanitize for SQLi
	$username = $_SESSION['username'];	// I believe this variable has already been sanitized from login.php...
	// $username = mysqli_real_escape_string($conn, $username);
	// $desc = mysqli_real_escape_string($conn, $desc);
	// $tag = mysqli_real_escape_string($conn, $tag);

	// Update tag table with new description
	echo "tag: " . $tag . "<br>";
	echo "desc: " . $desc . "<br>";
	echo "username: " . $username . "<br>"; // works
	echo "action: " . $action . "<br>"; // works

	$updatequery = "UPDATE tag_id SET description='$desc' WHERE tag_id = '$tag';";

	$result = mysqli_query($conn, $updatequery);
	if(!$result){
		$_SESSION['edit'] = 'false';
		mysqli_close($conn);
		header('Location: http://149.166.29.173/sales_side/tag.php');
		exit;
	}

	$_SESSION['edit'] = 'true';
	// mysqli_query($conn, $updatequery);
	mysqli_close($conn);
	header('Location: http://149.166.29.173/sales_side/tag.php');
} else {
// redirect back to tag.php if no action specified
// header('Location: management.php')
}
?>