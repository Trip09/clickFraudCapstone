<!DOCTYPE HTML>


<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
<?php

/* LOGIN
 * TODO: BRYDEN -> Close connections!
 */

// Initializes user session
session_start();

include 'session.php';

if (isset($_POST['button']) and $_POST['button'] == 'Logout')
{
  session_start();
  unset($_SESSION['username']);
  unset($_SESSION['error']);
  unset($_SESSION['login']);
  header('Location: http://149.166.29.173/sales_side/goodbye.php'); 
  exit();
}


// Retrieve Form Data
$username = $_POST['username'];
$password = $_POST['password'];

// Database connection
$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to mysqli: " . mysqlii_connect_error();
}

// Database query
// Returns password value.
$username = mysqli_real_escape_string($conn, $username);
$username = strtolower($username);
$query = "SELECT * 
          FROM member
          WHERE username = '$username';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) // User not found.
{
  $_SESSION['login'] = false;
  header('Location: index.php');
}

// User exists, check for correct password.
$userData = mysqli_fetch_array($result, MYSQL_BOTH);

$hash = $userData['salt'] . hash('sha256', $password);

if($hash != $userData['password']) // Incorrect password.
{
  $_SESSION['login'] = false;
  mysqli_close($conn);
  header('Location: index.php?login=error');
}else{                             // Valid login.
  // XSS HERE! $_POST['username'] is not sanitized
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['login'] = true;
  mysqli_close($conn);
	header('Location: dashboard.php');
}

?>

</body>
</html>