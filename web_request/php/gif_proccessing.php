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
 REMOTE_ADDR, HTTP_X_FORWARDED_FOR, HTTP_HOST, HTTP_REFERER ,
  HTTP_USER_AGENT, HTTP_ACCEPT_LANGUAGE, HTTP_ACCEPT_ENCODING, HTTP_ACCEPT_CHARSET,
  HTTP_ACCEPT, REQUEST_METHOD, REQUEST_TIME, REQUEST_TIME_FLOAT, HTTP_REFER, CURRENT_ADDR,
  PLUGIN_DETAILS, TIME_ZONE, SCREEN_SIZE, COOKIE_ENABLED, SYSTEM_FONTS, TIME_STAMP, TAG) VALUES (
        '$_SERVER[REMOTE_ADDR]',
        '$_SERVER[HTTP_X_FORWARDED_FOR]',
        '$_SERVER[HTTP_HOST]',
        '$_SERVER[HTTP_REFERER]', 
        '$_SERVER[HTTP_USER_AGENT]' ,
        '$_SERVER[HTTP_ACCEPT_LANGUAGE]' ,
        '$_SERVER[HTTP_ACCEPT_ENCODING]' ,
        '$_SERVER[HTTP_ACCEPT_CHARSET]' ,
        '$_SERVER[HTTP_ACCEPT]',
        '$_SERVER[REQUEST_METHOD]' ,
        '$_SERVER[REQUEST_TIME]' ,
        '$_SERVER[REQUEST_TIME_FLOAT]',
        '$_GET[httpRefer]',
        '$_GET[curretAddrs]',
        '$_GET[pluginDetails]',
        '$_GET[timeZone]',
        '$_GET[screenSize]',
        '$_GET[cookieEnabled]',
        '$_GET[systemFonts]',
        '$_GET[timestamp]',
        '$_GET[tag]')";

// Executes MySQL Query
$result = mysqli_query($conn, $query);

 $myFile = "console.txt";
 $fh = fopen($myFile, 'a') or die("can't open file");


if (!$result) {
  fwrite($fh,"error2:".mysqli_error($result) ."\n");
}
if (mysqli_connect_errno()) {
    fwrite($fh,"bad con:".mysqli_error($result) ."\n");
}
  fclose($fh);

echo  "query sucess <br>";

/**
 *
 * All the parameter processing logic goes here, no output allowed besides the gif
 * In this example I log the GET parameters to a log file
 *
 */
$myFile = "log.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, $_GET['systemFonts']."\n");
fclose($fh);

/**
 * It now returns the gif to the browser
 *
 */ 
header('Content-type: image/gif'); //Sets the header
include('../img/babygif.gif'); // returns the gif
