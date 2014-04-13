<?php

session_start();


//Set up the active navigation item appearance
function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        return 'class="active"';
}

// Login Form.
// user is loggeg out.
$logged_out = '<label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Name" />
              <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" />
          </div>
          <input type="submit" class="btn btn-sm btn-default"
          name="button" id="button" value="Submit"/>
        </form>';

$logged_out_error = '<label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Name" />
      <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" />
  </div>
  <input type="submit" class="btn btn-sm btn-default"
  name="button" id="button" value="Submit"/>
  <p style="color: red;margin: 0 0 0 80px;">Invalid credentials. Try again.</p>
</form>';

// user is logged in.
$logged_in = '<h4 id="welcome-message">Welcome, ' . $_SESSION['username'] 
  .'</h4></div>
  <input type="submit" class="btn btn-sm btn-default" 
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
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
  ';


?>