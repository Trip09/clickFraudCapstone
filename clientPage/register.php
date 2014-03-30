<?php
$username = $_POST['username'];
$password1 = $_POST['password'];
$password2 = $_POST['veripass'];
$email = $_POST['email'];
$vemail = $_POST['vemail'];
$sToken = $_POST['sToken'];

if($password1 != $password2){
    header('Location: registration.php');
}
if(strlen($username) > 10){
    header('Location: registration.php');
}

$hash = hash('sha256', $password1);

// Define functions...
function createSalt()
{
    $text = md5(uniqid(rand(), true));
    return substr($text, 0, 3);
}

function checkToken(){
	// check synchronizer token against hidden field
	if(($sToken == $_SESSION['token'])){
// Verify the below works...
		session_destroy();
	}
}

function checkUsername(){
	// check if username meets requirements
	// sanitize input before querying the database

	$username = mysqli_escape_string()
	$query = "SELECT * FROM member WHERE username = '$username';"
	$result = mysqli_query($conn, $query);

	// check if username is unique in the database
	if(mysqli_num_rows($result) != 0)
	{
		$_SESSION['error'] = true;
		echo " Username already exists ";
		header('Location: index.php');
	}
}

function checkEmail(){
	// check if email exists in the database
	$email = mysqli_escape_string()
	$vemail = mysqli_escape_string()
	$query = "SELECT * FROM member WHERE email = '$email';"
	$result = mysqli_query($conn, $query);

	// check if email == vemail
	if($email != $vemail){
		$_SESSION['error'] = true;
		echo " Please verify your email addresses match. ";
		header('Location: index.php');
	}

	// check if email is unique in the database
	if(mysqli_num_rows($result) != 0)
	{
		$_SESSION['error'] = true;
		echo " This email address has already been registered ";
		header('Location: index.php');
	}
	// else email is unique

}

function checkPasswd(){
	// verify passwd == vpasswd
	if($password1 != $password2){
		$_SESSION['error'] = true;
		echo " Please verify your passwords match. ";
		header('Location: index.php');
	}

	// verify password meets complexity -- complexity = min. 12 characters, etc
	if ($password.length < 12)
	  alert("Invalid password length. Your password needs to be longer than 12 characters.");
	var hasUpperCase = /[A-Z]/.test($password);
	var hasLowerCase = /[a-z]/.test($password);
	var hasNumbers = /\d/.test($password);
	var hasNonalphas = /\W/.test($password);
	if (hasUpperCase + hasLowerCase + hasNumbers + hasNonalphas < 3)
	{
		$_SESSION['error'] = true;
		echo " Your password does not meet complexity requirements. It
	  		must have at least three of the following requirements: upper case letter, 
	  		one lower case letter, a number, and a symbol as well as be larger than 12 characters.");
		header('Location: index.php');
	}


}
// end functions

// Validation:
checkToken();
checkUsername();
checkEmail();
checkPasswd();

$salt = createSalt();
$password = hash('sha256', $salt . $hash);

$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo "alive <br>";
//sanitize username - change function
$username = mysql_real_escape_string($username);

$password = $password1;

$query = "INSERT INTO member ( username, password, email, salt)
        VALUES ( '$username', '$password', '$email', '$salt');";
$result = mysqli_query($conn, $query);

echo  "query sucess <br>";

?>