<?php
$username = $_POST['username'];
$password1 = $_POST['password'];
$password2 = $_POST['veripass'];
$email = $_POST['email'];

if($password1 != $password2){
    header('Location: registration.html');
}
if(strlen($username) > 10){
    header('Location: registration.html');
}   
$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo "alive <br>";
$password = $password1;

$query = "INSERT INTO member ( username, password, email)
        VALUES ( '$username', '$password', '$email');";
$result = mysqli_query($conn, $query);

echo  "query sucess <br>";

?>
