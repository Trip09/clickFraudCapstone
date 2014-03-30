<?php

$username = $_POST['username'];
$password1 = $_POST['password'];
$password2 = $_POST['veripass'];
$email = $_POST['email'];
$vemail = $_POST['vemail'];
$sToken = $_POST['sToken'];
$session = $_SESSION['token'];

session_start();

echo "session_id: ".session_id()."\n";
echo "session token: ".$_SESSION['token']."\n";
echo "sToken: ".$sToken."\n";

echo "password1: ".$password1."\n";
echo "password2: ".$password2."\n";

$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

/*if($password1 != $password2){
    header('Location: registration.php');
}
if(strlen($username) > 10){
    header('Location: registration.php');
}*/

$hash = hash('sha256', $password1);

// Define functions...
function createSalt()
{
	$text = md5(uniqid(rand(), true));
    return substr($text, 0, 3);
}

function checkToken($secretToken, $sessionToken){
	echo "Our secret token is: $secretToken\n";
	echo "Our session token is: ".$sessionToken."\n";
	// check synchronizer token against hidden field
	if($secretToken != $sessionToken){
// Verify the below works...
		echo "Invalid session token!";
		// header('Location: index.php');
		session_destroy();
	} else {
		echo " Session token is valid!!!!\n";		
	}
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
		echo " Username already exists ";
		header('Location: registration.php?error=1'); // use _GET over on the registration.php page
		// header('Location: index.php');
	} else {
		echo "Valid username\n";
	}
}

function checkEmail($email, $vemail, $conn){
	// check if email exists in the database
	$email = mysqli_escape_string();
	$vemail = mysqli_escape_string();
	$query = "SELECT * FROM member WHERE email = '$email';";
	$result = mysqli_query($conn, $query);

	// check if email == vemail
	if($email != $vemail){
		$_SESSION['error'] = true;
		echo " Please verify your email addresses match. ";
		// header('Location: registration.php');
	}

	// check if email is unique in the database
	if(mysqli_num_rows($result) != 0)
	{
		$_SESSION['error'] = true;
		echo " This email address has already been registered ";
		// header('Location: registration.php');
	}
	// else email is unique
}

function checkPasswd($password1, $password2){
	// verify passwd == vpasswd
	if($password1 != $password2){
		$_SESSION['error'] = true;
		echo " Please verify that your passwords match. ";
		// header('Location: index.php');
	}

	echo "password1 = $password1\n";

	// verify password meets complexity -- complexity = min. 12 characters, etc
	if (strlen($password1) < 12){
		echo "Invalid password length. Your password needs to be longer than 12 characters.";
	}

	$hasUpperCase = preg_match("/[A-Z]/", $password1);
	$hasLowerCase = preg_match("/[a-z]/", $password1);
	$hasNumbers = preg_match("/[0-9]/", $password1);
	$hasNonalphas = preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $password1);

	echo " value of hasUpperCase = ".$hasUpperCase."\n";
	echo " value of hasLowerCase = ".$hasLowerCase."\n";
	echo " value of hasNumbers = ".$hasNumbers."\n";
	echo " value of hasNonalphas = ".$hasNonalphas."\n";

	if ($hasUpperCase + $hasLowerCase + $hasNumbers + $hasNonalphas < 3)
	{
		$_SESSION['error'] = true;
		echo " Your password does not meet complexity requirements. It
	  		must have at least three of the following requirements: upper case letter, 
	  		one lower case letter, a number, and a symbol as well as be larger than 12 characters.";
		// header('Location: index.php');
	}
}
// end functions

// Validation:
checkToken($sToken, $_SESSION['token']);
checkUsername($username, $conn);
checkEmail($email, $vemail, $conn);
checkPasswd($password1, $password2);

$salt = createSalt();
$password = hash('sha256', $salt . $hash);

echo "salt: ".$salt."\n";
echo "alive <br>";

//sanitize username - change function
$username = mysqli_real_escape_string($conn, $username);

$query = "INSERT INTO member ( username, password, email, salt)
        VALUES ( '$username', '$password', '$email', '$salt');";
$result = mysqli_query($conn, $query);

echo  "query sucess <br>";

?>