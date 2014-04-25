<?php
session_start();
include 'session.php';

// TODO: Add active class jazz later
// function echoActiveClassIfRequestMatches($requestUri)
// {
//     $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

//     if ($current_file_name == $requestUri)
//         return 'class="active"';
// }

function generateRandomTag() {

	// Generate the random tag:
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$randomTag = '';
	for ($i = 0; $i < 16; $i++) {
		 $randomTag .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $randomTag;
}

function checkDB($verifyUniqueID) {

	// Check the database for uniqueness:
	$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
	if (mysqli_connect_errno() ){
		echo "Failed to connect to mysqli: " . mysqli_connect_error();
	}

// Check if the tagID generated is unique
	$query = "SELECT * FROM tag_id WHERE tag_ID = '$verifyUniqueID';";
	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) != 0)
	{
		mysqli_close($conn);
		return false;
	} else {
		mysqli_close($conn);
		return true;
	}


} // end checkDB($tag)

// Generate unique tag for the customer if action=create
$tag = '';
if($_GET['action'] == 'create'){
	$keepGoing = true;
	// $tag = '';
	// TEMP:
				$tag = generateRandomTag();
				// echo "tag: " . $tag;
	// while($keepGoing){
		// $tag = generateRandomTag();
		// $keepGoing = checkDB($tag);
	// }
}

// if($_GET['action'] == 'delete'){
// 	echo "delete action";
// }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

		<title>My Dashboard - Tag Management</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/dashboard.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<!-- Navigation Bar 
		================================================== -->
		<?php include "navbar.php" ?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><a href="http://149.166.29.173/sales_side/dashboard.php">Dashboard Home</a></li>
						<li class="active"><a href="http://149.166.29.173/sales_side/tag.php">Tag Management</a></li>
						<li><a href="#">Reports</a></li>
						<li><a href="#">Analytics</a></li>
						<li><a href="#">Tag</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="z-index: 0;">
<?php
	
	if($_GET['action'] == 'create'){

		echo '<h1 class="page-header">Create a new tag</h1>
					<div id="createTag">
						<form role="form" method="post" action="mgmtsubmit.php">
							<div class="form-group">
								<label for="description">Description</label>
								<input class="form-control" id="description" name="description" placeholder="Enter a description, such as a site where this tag will be used" required>
								<p>The description will be used to identify this particular tag, so make this something unique!</p>
								<input type="hidden" name="tagID" value="'. $tag . '" />
								<input type="hidden" name="action" value="create" />
							</div>
							<div id="dialog" title="Confirm delete">
							<button type="submit" class="btn btn-primary">Submit</button>
							<a class="btn btn-default" href="http://149.166.29.173/sales_side/tag.php" role="button">Cancel</a>
						</form>
					</div>';
	} else if($_GET['action'] == 'delete'){	
		echo '<h1 class="page-header">Delete tags</h1>
						<form role="form" method="post" action="mgmtsubmit.php">
							<input type="hidden" name="action" value="delete" />
		';

		include('table.php');

		echo '
							<p>Please confirm your selection before clicking the "Delete" button below!</p>
							<button type="submit" class="btn btn-danger">Delete</button>
							<a class="btn btn-default" href="http://149.166.29.173/sales_side/tag.php" role="button">Cancel</a>
						</form>
					</div>
					';

	} else if($_GET['action'] == 'edit'){
		$editTag = $_GET['tag'];

		// SQL query to display current tag description
		$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
		if (mysqli_connect_errno() ){
			echo "Failed to connect to mysqli: " . mysqli_connect_error();
		}
		// SQLi prevention by escaping the input from GET
		$editTag = mysqli_real_escape_string($conn, $editTag);

		$query = "SELECT * FROM tag_id WHERE tag_id = '$editTag';";

		$result = mysqli_query($conn, $query);
		if(!$result){
			$_SESSION['edit'] = 'false';
			mysqli_close($conn);
			header('Location: http://149.166.29.173/sales_side/tag.php');
			exit;
		}

		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		$currentDescription = $row[3]; // returns current description
		$currentDescription = htmlspecialchars($currentDescription); // Sanitize input to prevent XSS
		mysqli_close($conn);

		echo '<h1 class="page-header">Edit Tag</h1>
					<div id="editTag">
						<form role="form" method="post" action="mgmtsubmit.php">
							<div class="form-group">
								<label for="currentDescription">Current description</label>
								<p>' . $currentDescription . '</p>
								<label for="newdescription">Edit description</label>
								<input class="form-control" id="newdescription" name="newdescription" style="width: 40%" placeholder="Enter a new description">
								<input type="hidden" name="newtag" value="'. $editTag . '" />
								<input type="hidden" name="action" value="edit" />
							</div>
							<div id="dialog" title="Confirm delete">
							<button type="submit" class="btn btn-primary">Submit Description</button>
							<a class="btn btn-default" href="http://149.166.29.173/sales_side/tag.php" role="button">Cancel</a>
						</form>
					</div>';

	} else {
		header('Location: http://149.166.29.173/sales_side/tag.php');
	}


?>

				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/docs.min.js"></script>

	</body>
</html>