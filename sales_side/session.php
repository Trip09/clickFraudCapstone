<?php

// Session Management

session_start();

// Session Fixation Prevention
if(!isset($_SESSION['CREATED_TIME'])){
	// Set session creation to now
	$_SESSION['CREATED_TIME'] = time();
} else if(time() - $_SESSION['CREATED_TIME'] > 1800){
	// create new session to prevent fixation if the current session is more than 30 minutes
	session_regenerate_id(true);
	$_SESSION['CREATED_TIME'] = time();
}

// Expire sessions if they are more than 30 minutes
if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)){
	session_unset();
	session_destroy();
	// Maybe redirect to re-login page or something
	header('Location: index.php?timeout=true'); // or something
} else{
	$_SESSION['LAST_ACTIVITY'] = time();
}


?>