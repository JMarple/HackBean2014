<?php 
	
    echo "test";
    
	//$host = "localhost";
	$host = "us-cdbr-east-05.cleardb.net";
	//$user = "root";
	$user = "b85ad415edfa4d";
	//$pass = "";
	$pass = "df62fd56";
	
	$db = "hackbean";
	
	$mysqli = new mysqli($host, $user, $pass, $db);

	if ($mysqli->connect_errno) 
	{
  	  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	else
	{
		mysqli_query($mysqli, "INSERT INTO users (username, password) VALUES ('Justin', 'test')");
	}
	
	echo $mysqli->host_info . "\n";
	
	
	
	
?>

