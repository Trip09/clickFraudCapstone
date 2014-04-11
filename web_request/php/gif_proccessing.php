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
    // TODO: no output can be done here. This needs to be changed to output to log.
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


if(isset($_GET["cID"])) echo "cID is set and the value is: " . $_GET["cID"] . "\n"; 

/* Execute query
 * TODO: Need to add the parameters from the request.
 * 
 * Parameters;
 *   httpRefer
 *   timeZone
 *   pluginDetails
 *   & others. Please see js/Code.js
 */
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
    '$_SERVER[HTTPS]',);";

// Executes MySQL Query
$result = mysqli_query($conn, $query);

echo  "query sucess <br>";

/**
 *
 * All the parameter processing logic goes here, no output allowed besides the gif
 * In this example I log the GET parameters to a log file
 *
 */
$myFile = "log.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, serialize($_GET)."\n");
fclose($fh);

/**
 * It now returns the gif to the browser
 *
 */ 
header('Content-type: image/gif'); //Sets the header
include('../img/babygif.gif'); // returns the gif
