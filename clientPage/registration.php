<?php

/* Start session: */
session_start();

/* Generate Synchronizer Token: */
/* Temporary INSECURE method to generate a session token: */
$token = sha1(uniqid(microtime()));

/* Set token as Session Token: */
$_SESSION['token'] = $token;
//$_SESSION['token_time'] = time(); /* Time since UNIX epoc time; see http://php.net/manual/en/function.time.php for more information */
// echo "Token: $token";

$errorid = $_GET['error'];

$usererror = NULL;
$vemailerror = NULL;
$emailerror = NULL;
$tokenerror = NULL;
$pwderror = NULL;
$vpwderror = NULL;

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
    <h1>Register</h1>
    <form id="form1" name="form1" method="post" action="register.php">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required/>
        <?php if(isset($usererror)) echo '<font color="red"> * Username already exists.</font>'; ?>
        <br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required/>
        <?php if(isset($pwderror)) echo '<font color="red"> * Passwords must be more than 12 characters and contain three of the following: <br>    At least one uppercase letter, at least one lowercase letter, a number, or a symbol such as ! # $ % & \ ? or (space)</font>'; ?>
        
        <br>
        <label for="veripass">Verify Password</label>
        <input type="password" name="veripass" id="veripass" required/>
        <?php if(isset($vpwderror)) echo '<font color="red"> * Passwords do not match.</font>'; ?>
        <br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required/>
        <?php if(isset($emailerror)) echo '<font color="red"> * This email has already been registered.</font>'; ?>
        <br>
        <label for="vemail">Verify Email</label>
        <input type="vemail" name="vemail" id="vemail" required/>
        <?php if(isset($vemailerror)) echo '<font color="red"> * Email addresses do not match.</font>'; ?>
        <br>

        <input type="hidden" name="sToken" value="<?php echo htmlspecialchars($token) ?>" />
        <?php if(isset($tokenerror)) echo '<font color="red"> * There was an error submitting the form. Please resubmit.</font>'; ?>


        <input type="submit" name="button" id="button" value="Submit" />
    </form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>