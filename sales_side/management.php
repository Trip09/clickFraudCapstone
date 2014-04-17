<?php
session_start();


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
		echo "Failed to connect to mysqli: " . mysqlii_connect_error();
	}

// Check if the tagID generated is unique
	$query = "SELECT * FROM tags WHERE tagID = '$verifyUniqueID';";
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
		<link href="css/tag.css" rel="stylesheet">


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

		// echo generateRandomTag();
		echo '<h1 class="page-header">Create a new tag</h1>
					<div id="createTag">
						<form role="form" method="post" action="mgmtsubmit.php">
							<div class="form-group">
								<label for="description">Description</label>
								<input class="form-control" id="description" placeholder="Enter a description, such as a site where this tag will be used">
								<input type="hidden" name="tagID" value="<?php echo generateRandomTag() ?>" />
								<input type="hidden" name="action" value="create" />
							</div>

							<button type="submit" class="btn btn-default">Submit</button>
							<a class="btn btn-default" href="http://149.166.29.173/sales_side/tag.php" role="button">Cancel</a>
						</form>
					</div>';
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