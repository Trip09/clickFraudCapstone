<?php

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
// set customerID which will be the user_id in the query
$row = mysqli_fetch_row($result);
$customerID = $row[0]; // returns customer ID

// Retrieve tag info from tag table
$selectquery = "SELECT tag_id,description FROM tag_id WHERE user_id='$customerID';";
$tagresult = mysqli_query($conn, $selectquery);
$rows = mysqli_num_rows($tagresult);

// store results in associative array
$results_array = array();
while($line = mysqli_fetch_array($tagresult, MYSQL_ASSOC)){
	$results_array[] = $line;
}

// set up the beginning of the table
$i = 0;
echo '<table class="table table-striped">';
echo '
	<thead>
		<tr>
			<th></th>
			<th>#</th>
			<th>Tag</th>
			<th>Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	';

/* 

TODO:
	
		CHANGE THE LOCATION OF WHERE THE GIF PROCESSING WILL OCCUR!!!!!!!!!!! 
		CLEAN UP THE URL!!!!!!!!!

*/

if($_SERVER['PHP_SELF'] == '/sales_side/management.php'){
	// delete table
	while($i < $rows){
		$rownumber = $i + 1;
		echo '
				<tr>
					<td>
						<label class="checkbox">
							<input type="checkbox" name="checkbox_tag_array[]" value="' . $results_array[$i]['tag_id'] . '"/>
						</label>
					</td>
					<td>'. $rownumber .'</td>
					<td><code>http://149.166.29.173/web_request/php/gif_processing.php?tag='. $results_array[$i]['tag_id'] .'</td>
					<td>'.htmlspecialchars($results_array[$i]['description']).'</td>
				</tr>
				';
		
		// echo "<br>Tag ID: " . $results_array[$i]['tag_id'] . "<br>" . htmlspecialchars($results_array[$i]['description']) . "<br>";
		$i++;
	}

} else {
	while($i < $rows){
		// normal display table
		$rownumber = $i + 1;
		echo '
				<tr>
					<td></td>
					<td>'. $rownumber .'</td>
					<td><code>'. htmlspecialchars("<img src=\"http://149.166.29.173/web_request/php/gif_processing.php?tag=") . $results_array[$i]['tag_id'] . htmlspecialchars("\" height=\"1\" width=\"1\">") . '</code></td>
					<td>'.htmlspecialchars($results_array[$i]['description']).'</td>
					<td><a href="http://149.166.29.173/edit.php?tag=' . $results_array[$i]['tag_id'] . '">Edit</a></td>
				</tr>
				';
		
		// echo "<br>Tag ID: " . $results_array[$i]['tag_id'] . "<br>" . htmlspecialchars($results_array[$i]['description']) . "<br>";
		$i++;
	}
}

echo '
		</tbody>
	</table>
	';


mysqli_close($conn);
?>