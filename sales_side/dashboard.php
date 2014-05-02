<?php
session_start();
include 'session.php';

// Redirect if not logged in
if($_SESSION['login'] == false){
	header('Location: index.php');
}

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

<!-- GOOGLE CHARTS -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Total Traffic (# of hits)', 'Number of Tags'],
          ['Feb \'14',  1126,      7],
          ['March \'14',  1394,      9],
          ['April \'14',  9308,       13],
          ['May \'14',  18329,      21]
        ]);

        var options = {
          title: 'Traffic History',
          curveType: 'function',
          hAxis: {title: 'Dates',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<!-- END GOOGLE CHARTS -->
	</head>

	<body>
		<!-- Navigation Bar 
		================================================== -->
		<?php include "navbar.php" ?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li class="active"><a href="http://149.166.29.173/sales_side/dashboard.php">Dashboard Home</a></li>
						<li><a href="http://149.166.29.173/sales_side/tag.php">Tag Management</a></li>
						<li><a href="#">Reports (Coming soon!)</a></li>
						<li><a href="#">Analytics (Coming soon!)</a></li>
						<li><a href="http://149.166.29.173/sales_side/account.php">Your Account</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="z-index: 0;">
					<h1 class="page-header">Dashboard</h1>

					<div class="row placeholders">
						<div class="col-xs-6 col-sm-3 placeholder">
							<img data-src="holder.js/200x200/auto/sky/text:1 site" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4>Number of Monitored Sites</h4>
							<span class="text-muted">Current tags in use</span>
						</div>
						<div class="col-xs-6 col-sm-3 placeholder">
							<img data-src="holder.js/200x200/auto/social/text:1337 hits" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4>Daily Traffic Levels</h4>
							<span class="text-muted">The traffic we have captured</span>
						</div>
						<div class="col-xs-6 col-sm-3 placeholder">
							<img data-src="holder.js/200x200/auto/sky/text:13 percent" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4>% of Fraudulent Clicks</h4>
							<span class="text-muted">Traffic we think is bad</span>
						</div>
						<div class="col-xs-6 col-sm-3 placeholder">
							<img data-src="holder.js/200x200/auto/industrial/text:1163 real hits" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4>Actual Traffic</h4>
							<span class="text-muted">This is your real traffic</span>
						</div>
					</div>

							<?php include "traffictable.php" ?>

							<h2 class="sub-header">Traffic History</h2>
							<div id="chart_div" style="width: 900px; height: 500px;"></div>
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

