<?php 
	
	$host = "us-cdbr-east-05.cleardb.net";
	$user = "b85ad415edfa4d";
	$pass = "df62fd56";
	$db = "hackbean";
	
	$mysqli = new mysqli($host, $user, $pass, $db);


	if ($mysqli->connect_errno) {
  	  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	echo $mysqli->host_info . "\n";
?>

