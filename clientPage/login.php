<!DOCTYPE HTML>


<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
<?php
// Initializes user session
if( !isset($_SESSION) ) {
  session_start();

  $_SESSION['error'] =  false;
  $_SESSION['login'] = false;
} 

$username = $_POST['username'];
$password = $_POST['password'];

// Database connection
$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysql_select_db('login', $conn);

$username = mysql_real_escape_string($username);
$query = "SELECT password, salt
        FROM member
        WHERE username = '$username';";

$result = mysql_query($query);
 
if(mysql_num_rows($result) == 0) // User not found.
{
    $_SESSION['error'] = true;
  echo "NO USER";
    //header('Location: index.php');
}

// User exists, check for correct password.
$userData = mysql_fetch_array($result, MYSQL_ASSOC);
$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );

if($hash != $userData['password']) // Incorrect password.
{
    $_SESSION['error'] = true;
  echo "BAD PASSWORD";
   // header('Location: index.php');
}else{                             // Valid login.
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['login'] = true;
  echo "LOGGED IN";
	//header('Location: home.html');
}
?>

</body>
</html>
