<?php

session_start();


//Set up the active navigation item appearance
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri){
      return 'class="active"';
    }        
}

// Login Form.
// user is logged out.
$logged_out = '
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
          </div>
          <input type="submit" class="btn btn-sm btn-primary"
          name="button" id="button" value="Submit"/>
        </form>';

$logged_out_error = '
    <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
  </div>
  <input type="submit" class="btn btn-sm btn-primary" name="button" id="button" value="Submit"/>
  <div class="alert alert-danger fade in" style="width: 350px; margin: 10px 0 0 0">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4 style="margin-bottom: 0">Invalid credentials. Try again!</h4><h5 style="margin-bottom: 0"> Click <a href="#">here</a> if you forgot your login information.</h5>
  </div>
</form>';

// user is logged in.
$logged_in = '<h4 id="welcome-message">Welcome, ' . $_SESSION['username'] 
  .'</h4></div>
  <input type="submit" class="btn btn-sm btn-primary" 
  name="button" id="button" value="Logout" />';

$logged_in_nav_left = '<ul class="nav navbar-nav">
        <li ' . echoActiveClassIfRequestMatches("index") . '><a href="http://149.166.29.173/sales_side/index.php">Home</a></li>
        <li ' . echoActiveClassIfRequestMatches("about") . '><a href="http://149.166.29.173/sales_side/about.php">About</a></li>
        <li ' . echoActiveClassIfRequestMatches("dashboard") . '><a href="http://149.166.29.173/sales_side/dashboard.php">Dashboard</a></li>
      </ul>';

$logged_out_nav_left = '<ul class="nav navbar-nav">
        <li ' . echoActiveClassIfRequestMatches("index") . '><a href="http://149.166.29.173/sales_side/index.php">Home</a></li>
        <li ' . echoActiveClassIfRequestMatches("about") . '><a href="http://149.166.29.173/sales_side/about.php">About</a></li>
        <li ' . echoActiveClassIfRequestMatches("registration") . '><a href="http://149.166.29.173/sales_side/registration.php">Sign Up!</a></li>
      </ul>';

if( $_GET['login'] == 'logout' ){             // User requests logout
  $_SESSION['login'] = false;
} else if( $_SESSION['login'] == true) {      // Valid Login
  $form = $logged_in;
  $leftnav = $logged_in_nav_left;
} else if( $_GET['login'] == 'error'){     // User login name not found.
  $form = $logged_out_error;
  $leftnav = $logged_out_nav_left;
} else {
  // echo '<h1>NO LOGIN</h1> ';
  $form = $logged_out;
  $leftnav = $logged_out_nav_left;
};

echo '
<!-- Navigation Bar -->
    <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">TruClick - Click Fraud Detection</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">'
    .$leftnav
    .'<ul class="nav navbar-nav navbar-right">
    <!-- Login/Logout Form -->
    <form id="form1" class="login-form navbar-form navbar-left" name="form1" method="post" action="login.php">
    <div class="form-group">'
    .$form
    .'</form>  
    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Support</a></li>
            <li class="divider"></li>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
  ';


?>