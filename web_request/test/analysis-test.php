<?php
/* Analysis.php
 *
 *  Description:
 *  Data Created:
 *  Other:
 *  Author:
 *
 * * * * * * * * * * * * * */

//Connect to the Server.
$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// MAKE REQUESTS

//TODO: Add timer - what if sever dies connection should not hang
//function freegeoip_locate($ip){};

//function freegeoip_locate($ip) {
  //  $url = "http://freegeoip.net/json/".$ip;
    //$geo = json_decode(file_get_contents($url), true);
    //return $geo;
//}

// Retrieve Plugin Information
// TODO: Make a JS Call

/* Retrieve customer information */
/* cID will need to be sanitized before being used in a database query or HTML output*/
if(isset($_GET["cID"])) echo "cID is set and the value is: " . $_GET["cID"] . "\n"; 

// Retrieve TimeZone Information.
echo '</br>';
$date = new DateTime();
$date->setTimezone(new DateTimeZone('UTC'));
$date->setTimestamp(1297869844);
$date->setTimezone(new DateTimeZone('Europe/Paris'));
echo $date->format('Y-m-d H:i:s');

echo '</br> method 2</br>';
if (date_default_timezone_get()) {
    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
}

if (ini_get('date.timezone')) {
    echo 'date.timezone: ' . ini_get('date.timezone');
}
echo '</br> method 3 </br>';
session_start();
$timezone = $_SESSION['time'];
echo 'timezone: ' .$timezone;



// INSERT INFORMATION TO DATABADE

/*
foreach ($headers as $name => $value){
	echo "\n";
    echo "$name: $value\n";
    //Insert name value Jason Pair into table. 
   // $query = "INSERT INTO clicks ()
        //VALUES ( '$name', '$value');"; // Not quite sure how to finish this query.
	//$result = mysqli_query($conn, $query); // researching now. 

}
 */

// Ouput - Retrieval
echo "<br>". $_SERVER['REMOTE_ADDR']. "<br>";
echo $_SERVER['HTTP_X_FORWARDED_FOR']. "<br>";
echo "<br>". $_SERVER['GATEWAY_INTERFACE']. "<br>" . $_SERVER['SERVER_ADDR'] . "<br>"
    . $_SERVER['SERVER_SOFTWARE'] . "<br>" .  $_SERVER['SERVER_PROTOCOL'] . "<br>"
  . $_SERVER['REQUEST_METHOD'] . "<br>" .  $_SERVER['REQUEST_TIME'] . "<br>"
  . $_SERVER['REQUEST_TIME_FLOAT'] . "<br>" . $_SERVER['QUERY_STRING'] . "<br>"
  . $_SERVER['HTTP_ACCEPT_CHARSET'] . "<br>" . $_SERVER['HTTP_ACCEPT_ENCODING'] . "<br>"
  . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>" . $_SERVER['HTTP_CONNECTION'] . "<br>"
  . $_SERVER['HTTP_HOST'] . "<br>" . $_SERVER['HTTP_REFERER'] . "<br>"
  . $_SERVER['HTTP_USER_AGENT'] . "<br>" . $_SERVER['HTTPS'] . "<br>"
;

// Insert into database table
$query = "INSERT INTO clicks (
 REMOTE_ADDR, HTTP_X_FORWARDED_FOR, GATEWAY_INTERFACE, SERVER_ADDR, SERVER_SOFTWARE, SERVER_PROTOCOL ,
  REQUEST_METHOD, REQUEST_TIME, REQUEST_TIME_FLOAT, QUERY_STRING, HTTP_ACCEPT_CHARSET, HTTP_ACCEPT_ENCODING,
  HTTP_ACCEPT_LANGUAGE, HTTP_CONNECTION , HTTP_HOST, HTTP_REFERER, HTTP_USER_AGENT , HTTPS) VALUES (
    '$_SERVER[REMOTE_ADDR]',
    '$_SERVER[HTTP_X_FORWARDED_FOR]', 
    '$_SERVER[GATEWAY_INTERFACE]' ,
    '$_SERVER[SERVER_ADDR]' ,
    '$_SERVER[SERVER_SOFTWARE]', 
    '$_SERVER[SERVER_PROTOCOL]', 
    '$_SERVER[REQUEST_METHOD]' ,
    '$_SERVER[REQUEST_TIME]' ,
    '$_SERVER[REQUEST_TIME_FLOAT]' ,
    '$_SERVER[QUERY_STRING]', 
    '$_SERVER[HTTP_ACCEPT_CHARSET]' ,
    '$_SERVER[HTTP_ACCEPT_ENCODING]' ,
    '$_SERVER[HTTP_ACCEPT_LANGUAGE]' ,
    '$_SERVER[HTTP_CONNECTION]' ,
    '$_SERVER[HTTP_HOST]',
    '$_SERVER[HTTP_REFERER]' ,
    '$_SERVER[HTTP_USER_AGENT]' ,
    '$_SERVER[HTTPS]' );";

// Executes MySQL Query
$result = mysqli_query($conn, $query);

echo  "query sucess <br>";

//$geo = freegeoip_locate($_SERVER['REMOTE_ADDR']);

//echo "Country: " . $geo['country_name'];

// Broken:
/*$headers = apache_request_headers();

foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
}*/

// Broken:
/*$headers = getallheaders();

foreach ($headers as $name => $value) {
    echo "$name: $value\n";
    echo "made it here";
}*/
?>

