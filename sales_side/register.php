<?php

session_start();
include 'session.php';

$username = $_POST['username'];
$password1 = $_POST['password'];
$password2 = $_POST['veripass'];
$email = $_POST['email'];
$vemail = $_POST['vemail'];
$sToken = $_POST['sToken'];
$session = $_SESSION['token'];

$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');

if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// $hash = hash('sha256', $password1);

// Define functions...
function createSalt()
{
	$text = md5(uniqid(rand(), true));
    return substr($text, 0, 3);
}

function checkToken($secretToken, $sessionToken){
	// check synchronizer token against hidden field
	if($secretToken != $sessionToken){
		header('Location: registration.php?error=6');
		session_destroy();
	}

	return 1;
}

// email validation
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
}

function checkUsername($username, $conn){
	// check if username meets requirements
	// sanitize input before querying the database
	$username = mysqli_real_escape_string($conn, $username);
	$query = "SELECT * FROM member WHERE username = '$username';";
	$result = mysqli_query($conn, $query);

	// check if username is unique in the database
	if(mysqli_num_rows($result) != 0)
	{
		$_SESSION['error'] = true;
		header('Location: registration.php?error=1'); // use _GET over on the registration.php page
		exit();
	}

	return 1;
}

function checkEmail($email, $vemail, $conn){
	// check if email exists in the database
	// $email = mysqli_escape_string();
	// $vemail = mysqli_escape_string();
	$query = "SELECT * FROM member WHERE email = '$email';";
	$result = mysqli_query($conn, $query);

	// check if email == vemail
	if($email != $vemail){
		$_SESSION['error'] = true;
		header('Location: registration.php?error=2');
		exit();
	}

	$validEmail = isValidEmail($email);
	if(!($validEmail)){
		header('Location: registration.php?error=2');
		exit();
	}

	// check if email is unique in the database
	if(mysqli_num_rows($result) != 0)
	{
		$_SESSION['error'] = true;
		header('Location: registration.php?error=3');
		exit();
	}
	// else email is unique
	return 1;
}

function checkPasswd($password1, $password2){
	// verify passwd == vpasswd
	if($password1 != $password2){
		$_SESSION['error'] = true;
		// echo " Please verify that your passwords match. ";
		header('Location: registration.php?error=5');
		exit();
	}

	// verify password meets complexity -- complexity = min. 12 characters, etc
	if (strlen($password1) < 12){
		header('Location: registration.php?error=4');
		exit();
	}

	$hasUpperCase = preg_match("/[A-Z]/", $password1);
	$hasLowerCase = preg_match("/[a-z]/", $password1);
	$hasNumbers = preg_match("/[0-9]/", $password1);
	$hasNonalphas = preg_match("/[!#$%&\?_ ]/", $password1);

	if ($hasUpperCase + $hasLowerCase + $hasNumbers + $hasNonalphas < 3)
	{
		$_SESSION['error'] = true;
		header('Location: registration.php?error=4');
		exit();
	}
	return 1;
}
// end functions

// Validation:
$validationResult = checkToken($sToken, $_SESSION['token']) + checkUsername($username, $conn) + checkEmail($email, $vemail, $conn) + checkPasswd($password1, $password2);

// This is being called when it should not be called when the email validation fails
// Behavior:
//		When email fails to validate, the INSERT SQL statement is still running and creating a new entry in the user table
if($validationResult == 4){
	
	$hash = hash('sha256', $password1);
	$salt = createSalt();
	$password = $salt . $hash;

	$username = mysqli_real_escape_string($conn, $username);

	$query = "INSERT INTO member ( username, password, email, salt)
	        VALUES ( '$username', '$password', '$email', '$salt');";
	$result = mysqli_query($conn, $query);

	// echo  "query sucess <br>";
	// Redirect to page thanking the user for registering
	header('Location: thanks.php');

}

?>