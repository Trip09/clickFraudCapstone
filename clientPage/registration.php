<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/client.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Navigation Bar 
    ================================================== -->
    <?php include "navbar.php" ?>


    <!-- Register Form -->
    <h1>Register</h1>
    <form id="form1" name="form1" method="post" action="register.php">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required/>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required/>
        <label for="veripass">Verify Password</label>
        <input type="password" name="veripass" id="veripass" required/>
<!--  <label for="firstname">First Name</label>
       <input type="text" name="firstname" id="firstname" required/>
      <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" required/> 
-->
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required/>
      <input type="submit" name="button" id="button" value="Submit" />
    </form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
