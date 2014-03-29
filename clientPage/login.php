<!DOCTYPE HTML>


<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
 
$conn = mysql_connect('localhost', 'bitnami', 'click_fraud');
mysql_select_db('login', $conn);
 
$username = mysql_real_escape_string($username);
$query = "SELECT password, salt
        FROM member
        WHERE username = '$username';";
 
$result = mysql_query($query);
 
if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.
{
    header('Location: login.html');
}
 
$userData = mysql_fetch_array($result, MYSQL_ASSOC);
$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
 
if($hash != $userData['password']) // Incorrect password. So, redirect to login_form again.
{
    header('Location: login.html');
}else{ // Redirect to home page after successful login.
	header('Location: home.html');
}
?>

</body>
</html>
