<?php 
	
	session_start();
	
	if(isset($_SESSION['login']))
	{
		//Terribly insecure way to log in, to be changed
		$user = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$result = mysql_query("SELECT * FROM users WHERE username = $user");
		
		$row = mysql_fetch_assoc($result);
		
		
		
	}
	
    echo "another test";
    
	//$host = "localhost";	
	//$user = "root";	
	//$pass = "";

	$host = "us-cdbr-east-05.cleardb.net";
	$user = "b85ad415edfa4d";
	$pass = "df62fd56";
		
	$db = "hackbean";
		
	mysql_connect($host, $user, $pass);
	mysql_select_db($db);
	
	mysql_query("INSERT INTO `heroku_807bde1acfd096e`.`hackbean` (`username`, `password`) VALUES ('Justin', 'test2')");
?>

