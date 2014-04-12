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

// Retrieve Form Data
$username = $_POST['username'];
$password = $_POST['password'];

// Initializes user session
if( !isset($_SESSION) ) {
  session_start();
  $_SESSION['login'] = false;
} else { 
  session_start();
}
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
