<?php

session_start();
include 'session.php';

if($_SESSION['login'] == false){
	header('Location: index.php');
}

?>

<!-- TODO: CHange active state for the lefthand navigation menu -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

		<title>My Dashboard</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/dashboard.css" rel="stylesheet">

		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
						<li><a href="http://149.166.29.173/sales_side/tag.php">Tag Management</a></li>
						<li><a href="#">Reports (Coming soon!)</a></li>
						<li><a href="#">Analytics (Coming soon!)</a></li>
						<li class="active"><a href="http://149.166.29.173/sales_side/account.php">Your Account</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="z-index: 0;">
					<h1 class="page-header">Your Account</h1>

					<form role="form" class="form-horizontal" id="form1" name="form1" method="post" action="register.php">
						<div class="form-group">
							<label for="username" class="col-sm-2 control-label">Your Username</label>
							<div class="col-sm-4">
								<input type="text" name="username" id="username" class="form-control" placeholder="<?php echo $_SESSION['username'] ?>" disabled>

							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-4">
								<input type="password" name="password" id="password" class="form-control" placeholder="Change your password" disabled>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-4">
								<input type="email" name="email" id="email" class="form-control" placeholder="Your email" disabled>
								<?php if(isset($emailerror)) echo '<font color="red"> * This email has already been registered.</font>'; ?>
							</div>
						</div>

					</form>
				
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

