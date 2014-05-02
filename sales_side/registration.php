<?php

/* Start session: */
session_start();

/* Generate Synchronizer Token: */
/* Temporary INSECURE method to generate a session token: */
$token = sha1(uniqid(microtime()));

/* Set token as Session Token: */
$_SESSION['token'] = $token;
//$_SESSION['token_time'] = time(); /* Time since UNIX epoc time; see http://php.net/manual/en/function.time.php for more information */

$errorid = $_GET['error'];

$usererror = NULL;
$vemailerror = NULL;
$emailerror = NULL;
$tokenerror = NULL;
$pwderror = NULL;
$vpwderror = NULL;
$invaliduser = NULL;

/* FINISH THE ERROR CASES FOR INVALID INPUT */
// Use $_POST['nameoferror_error'] = 1
// This will be checked by <?php if(isset($nameoferror)) echo '<h5><font color="red">'.$nameoferror.'</font></h5>'; ? >
  // in each input form
// 0 = no error
// 1 = username already exists
// 2 = email and verify email do not match
// 3 = email is already registered
// 4 = password does not meet complexity requirements
// 5 = passwords do not match
// 6 = token validation error
// 7 = invalid username characters

if(isset($errorid)){
  switch($errorid){
    case 1:
      $usererror = 1;
      break;
    case 2:
      $vemailerror = 1;
      break;
    case 3:
      $emailerror = 1;
      break;
    case 4:
      $pwderror = 1;
      break;
    case 5:
      $vpwderror = 1;
      break;
    case 6:
      $tokenerror = 1;
      break;
    case 7:
      $invaliduser = 1;
    default:

  }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

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
    <div id="regForm">
      <h1 id="reg">Register</h1>
      <hr>
      <h3>Create a free account to see an analysis of the traffic to your site in just a few steps!</h3>
      <br>
      <form role="form" class="form-horizontal" id="form1" name="form1" method="post" action="register.php">
        <div class="form-group">
          <label for="username" class="col-sm-2 control-label">Username</label>
          <div class="col-sm-10">
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Name" required/>
            <?php if(isset($usererror)) echo '<font color="red"> * Username already exists.</font>'; ?>
            <?php if(isset($invaliduser)) echo '<font color="red"> * Username must only contain letters and numbers.</font>'; ?>
          </div>
        </div>

        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required/>
            <?php 
            if(isset($pwderror)) {
              echo '<font color="red"> * Passwords must be more than 12 characters long and contain three of the following: <br>1) At least one uppercase letter<br>2) At least one lowercase letter<br>3) A number<br>4) A symbol such as ! # $ % & \ ? or (space)</font>';
            } else {
              echo '<p class="help-block">Passwords must be more than 12 characters long and contain three of the following: <br>1) At least one uppercase letter<br>2) At least one lowercase letter<br>3) A number<br>4) A symbol such as ! # $ % & \ ? or (space)<p>';}
            ?>
          </div>
        </div>
        <div class="form-group">
          <label for="veripass" class="col-sm-2 control-label">Verify Password</label>
          <div class="col-sm-10">
            <input type="password" name="veripass" id="veripass" class="form-control" placeholder="Re-enter Password" required/>
            <?php if(isset($vpwderror)) echo '<font color="red"> * Passwords do not match.</font>'; ?>
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required/>
            <?php if(isset($emailerror)) echo '<font color="red"> * This email has already been registered.</font>'; ?>
          </div>
        </div>
        <div class="form-group">
          <label for="vemail" class="col-sm-2 control-label">Verify Email</label>
          <div class="col-sm-10">
            <input type="vemail" name="vemail" id="vemail" class="form-control" placeholder="Re-enter Email" required/>
            <?php if(isset($vemailerror)) echo '<font color="red"> * Email addresses do not match.</font>'; ?>
          </div>
        </div>

          <input type="hidden" name="sToken" value="<?php echo htmlspecialchars($token) ?>" />
          <?php if(isset($tokenerror)) echo '<font color="red"> * There was an error submitting the form. Please resubmit.</font>'; ?>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="button" id="button" class="btn btn-primary" value="Submit" />
            <a class="btn btn-default" href="http://149.166.29.173/sales_side/index.php" role="button">Cancel</a>
          </div>
        </div>
      </form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>