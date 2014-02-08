<?php 
	
    echo "test";
    
	/*//$host = "localhost";
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
	
	echo $mysqli->host_info . "\n";*/
    
    //$url=parse_url(getenv("CLEARDB_DATABASE_URL"));
    
    //$server = "localhost"; 
    $server = "us-cdbr-east-05.cleardb.net";
    //$username = "root"; 
    $username = "b85ad415edfa4d";
    //$password = ""; 
    $password = "df62fd56";
    $db = "hackbean";
    
    mysql_connect($server, $username, $password);
	
    mysql_select_db($db);
    
    mysql_query("INSERT INTO users (username, password) VALUES ('Justin', 'test')");
	
?>

