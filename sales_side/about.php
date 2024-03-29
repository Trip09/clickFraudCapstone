<?php

session_start();
include 'session.php';

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

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/client.css" rel="stylesheet">

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

    <div class="container">

      <h1>About Us</h1>
      <hr>
      <h2>Who We Are</h2>
      <p>We are a team of three undergrad computer science students at IUPUI.</p>

      <h2>Our Product</h2>
      <p>We have created a solution to maximize the return on advertising campaign investments. With our TruClick service, clients are able to view an in-depth analysis of advertisement traffic to their websites. We use custom machine learning techniques and models to determine the quality of traffic sent to a website from an advertisement.</p>

    </div> <!-- /container -->

  </body>
</html>