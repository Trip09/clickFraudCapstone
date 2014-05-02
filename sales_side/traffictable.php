<?php

// Traffic Table to display client traffic requests
// Creates dynamic table in HTML from SQL tag retrieval query 
session_start();

$conn = mysqli_connect('localhost', 'bitnami', 'click_fraud','click_fraud');
if (mysqli_connect_errno() ){
	echo "Failed to connect to mysqli: " . mysqli_connect_error();
}

// retrieve customer's ID to use in the DB
$username = $_SESSION['username'];	// I believe this variable has already been sanitized from login.php...
$username = mysqli_real_escape_string($conn, $username);
$query = "SELECT id FROM member WHERE username = '$username';";
$result = mysqli_query($conn, $query);

//remove later
if(!$result){
	echo "Could not run query.";
	mysqli_close($conn);
	echo "\n DB connection closed.";
	exit;
}
// BEGIN DROPDOWN
// set customerID which will be the user_id in the query to find all tags owned by this user
$row = mysqli_fetch_row($result);
$customerID = $row[0]; // returns customer ID

$getTags = "SELECT * FROM tag_id WHERE user_id = '$customerID';";
$getTagsResult = mysqli_query($conn, $getTags);
$tagRows = mysqli_num_rows($getTagsResult);

$dropdownTag = htmlspecialchars($_POST['tagform']);

echo '
<h2 class="sub-header">Recent Site Traffic</h2>

<div class="table-responsive">
	<table class="table table-striped">
		<form id="tagList" method="post" action="dashboard.php">
			<select name="tagform" onchange="this.form.submit()">
				<option value=""></option>
	';

while($tagLine = mysqli_fetch_array($getTagsResult, MYSQL_ASSOC)){
	echo "<option value=".$tagLine['tag_id'].">".$tagLine['tag_id']."</option>";
}
echo '
			</select>
		</form>
	';
// END DROP DOWN

// Retrieve tag info from tag table
// last # hits:
	// Use a 'correlated sub select' or some other more complex query to query the tag_id table to see if the tag belongs to the customerID
$selectquery = "SELECT DISTINCT * FROM clicks WHERE tag = '$dropdownTag' ORDER BY `id` DESC LIMIT 10";

$tagresult = mysqli_query($conn, $selectquery);
$rows = mysqli_num_rows($tagresult);

if($rows < 1){
	echo "<h5>No traffic data available for tag ID:<strong> ".$dropdownTag."</strong></h5>";
}else{
	echo "<h5>Latest traffic for tag ID: <strong>".$dropdownTag."</strong></h5>";
}

// store results in associative array
$results_array = array();
while($line = mysqli_fetch_array($tagresult, MYSQL_ASSOC)){
	$results_array[] = $line;
}

// set up the beginning of the table
$i = 0;
// open table
echo '
	<thead>
		<tr>
			<th>#</th>
			<th>IP Address</th>
			<th>Referred From</th>
			<th>Destination</th>
			<th>Time</th>
			<th>Bot?</th>
		</tr>
	</thead>
	<tbody>
	';

// table body
while($i < $rows){
	// normal display table
	$rownumber = $i + 1;
	$requestDate = date('Y-m-d g:i:s a', strftime($results_array[$i]['REQUEST_TIME']));
	echo '
			<tr>
				<td>'. $rownumber .'</td>
				<td>'.htmlspecialchars($results_array[$i]['REMOTE_ADDR']).'</td>
				<td>'.htmlspecialchars($results_array[$i]['HTTP_REFERER']).'</td>
				<td>'.htmlspecialchars($results_array[$i]['HTTP_HOST']).'</td>
				<td>'.htmlspecialchars($requestDate).'</td>
				<td>n/a</td>
			</tr>
			';
	
	$i++;
}

// close table
echo '
		</tbody>
	</table>
</div>
	';

mysqli_close($conn);


?>