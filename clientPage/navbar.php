<?php

if( !isset($_SESSION) ) {
  session_start();

  $_SESSION['error'] =  false;
  $_SESSION['login'] = false;
}

$logged_out = '<label for="username">Username</label>
        <input type="text" name="username" id="username" />
          <label for="password">Password</label>
        <input type="password" name="password" id="password" />
        </div>
        <input type="submit" class="btn btn-sm btn-default" name="button" id="button" value="Submit" />';

$logged_in = '<p id="welcome-message">Welcome, '.$_SESSION['username'] 
        .'</p></div>
          <input type="submit" class="btn btn-sm btn-default" name="button" id="button" value="Logout" />';

if( $_SESSION['login']) { // Valid Login
  $form = $logged_in;
} else {
  $form = $logged_out;
}

if($_SESSION['error']){
  echo '<h1>LOGIN FAIL</h1>';
}


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
      <a class="navbar-brand" href="#">Brand</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
       <li><a href="#">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dashboard <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
    <!-- Login Form -->
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
</nav>';

?>

