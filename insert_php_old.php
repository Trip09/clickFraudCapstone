<!DOCTYPE html>

<html>
<head>
    <title>PHP Insert Test</title>
</head>

<body>
    
<?php
$con=mysqli_connect("localhost","bitnami","click_fraud","click_fraud");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
echo "I'm Alive";
mysqli_query($con,"INSERT INTO test (userId, origin, current, ip, countryCode, countryName, regionCode, regionName,
             city, zipCode, latitude, longitude, metroCode, areaCode, pageViewFrequency, userAgent, visitDepth, visitLength)
VALUES ($_GET["uid"], $_GET["origin"], $_GET["current"], $_GET["ip"], $_GET["countryCode"], $_GET["countryName"],
        $_GET["regionCode"], $_GET["regionName"], $_GET["city"], $_GET["zipCode"], $_GET["latitude"],
        $_GET["longitude"], $_GET["metroCode"], $_GET["areaCode"], $_GET["pageViewFrequency"], $_GET["userAgent"],
        $_GET["visitDepth"], $_GET["visitLength"])");
	
	
mysqli_close($con);
?>


</body>
</html>
