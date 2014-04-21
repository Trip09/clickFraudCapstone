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


// echo " username: " . $username;
// echo " password: " . $password;

// Database connection
$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to mysqli: " . mysqlii_connect_error();
}
// echo "Connection Success";
/*$result = mysql_query("SELECT * FROM member");


while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
    printf ("ID: %s  Name: %s", $row[0], $row[1]);
}
*/
//TODO: remove possibly
//mysqli_select_db($conn,'click_fraud');

// Database query
// Returns password value.
$username = mysql_real_escape_string($username);
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
//TODO: Hash passwords
$userData = mysqli_fetch_array($result, MYSQL_BOTH);
// echo " database " . $userData[0] . " // ";
$hash = $userData['salt'] . hash('sha256', $password);

if($hash != $userData['password']) // Incorrect password.
{
  $_SESSION['login'] = false;
  header('Location: index.php?login=error');
}else{                             // Valid login.
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['login'] = true;
	header('Location: dashboard.php');
}
?>

</body>
</html>