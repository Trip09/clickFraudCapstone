<?php
$username = $_POST['username'];
$password1 = $_POST['password'];
$password2 = $_POST['veripass'];
$email = $_POST['email'];

if($password1 != $password2){
    header('Location: registration.php');
}
if(strlen($username) > 10){
    header('Location: registration.php');
}

$hash = hash('sha256', $password1);
 
function createSalt()
{
    $text = md5(uniqid(rand(), true));
    return substr($text, 0, 3);
}
 
$salt = createSalt();
$password = hash('sha256', $salt . $hash);

$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo "alive <br>";
//sanitize username
$username = mysql_real_escape_string($username);

$password = $password1;

$query = "INSERT INTO member ( username, password, email, salt)
        VALUES ( '$username', '$password', '$email', '$salt');";
$result = mysqli_query($conn, $query);

echo  "query sucess <br>";

?>
