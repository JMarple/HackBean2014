<?php 

	$host = "us-cdbr-east-05.cleardb.net";
	$user = "b85ad415edfa4d";
	$pass = "df62fd56";
	$db = "hackbean";
	
	$mysqli = new mysqli($host, $user, $pass, $db);

	echo "Database Connection Test";
?>