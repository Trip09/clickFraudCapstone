<?php
session_start();


// TODO: Add active class jazz later
// function echoActiveClassIfRequestMatches($requestUri)
// {
//     $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

//     if ($current_file_name == $requestUri)
//         return 'class="active"';
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
            <li class="active"><a href="http://149.166.29.173/sales_side/tag.php">Tag Management</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Tag</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="z-index: 0;">
          <h1 class="page-header">Tag Management</h1>

          <div>
            <h2 class="sub-header">My Tags</h2>

              <?php include "table.php" ?>

              <!-- <input type="submit" class="btn btn-large btn-primary" name="button" id="button" value="Submit"/> -->
              <a class="btn btn-large btn-primary" href="management.php?action=create">Create New Tag</a>
              <a class="btn btn-large btn-danger" href="management.php?action=delete">Delete Tags</a>

          </div>

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