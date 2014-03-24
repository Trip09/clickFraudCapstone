<!-- This is the page that is called from an image tag that will retrieve the request details -->

<?php

print <<< HERE


HERE;

echo "Request information: \n";

/* Retrieve customer information */
if(isset($_GET["cID"])) echo "cID is set and the value is: " . $_GET["cID"] . "\n"; /* cID will need to be sanitized before being used in a database query or HTML output*/

echo "User-Agent: " . $_SERVER["HTTP_USER_AGENT"]; /* Display the user's UA */

echo "\n Show all HTTP headers using getallheaders(): \n";

// Testing

if (!function_exists('getallheaders')) 
{ 
	echo "Function does NOT exist\n";

    function getallheaders() 
    { 
           $headers = ''; 
       foreach ($_SERVER as $name => $value) 
       { 
           if (substr($name, 0, 5) == 'HTTP_') 
           { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers; 
    } 
} 

$headers = getallheaders();

echo "\n\n\n";

foreach ($headers as $name => $value) {
	echo "\n";
    echo "$name: $value\n";
}

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
