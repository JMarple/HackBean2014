<?php 
	
	session_start();

	$host = "us-cdbr-east-05.cleardb.net";
	$user = "b85ad415edfa4d";
	$pass = "df62fd56";
	
	$db = "hackbean";
	
	mysql_connect($host, $user, $pass);
	mysql_select_db($db);
	
	/* LOGIN */
	if(isset($_POST['login']))
	{
		//Terribly insecure way to log in, to be changed
		$user = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		
		if($result = mysql_query("SELECT * FROM `heroku_807bde1acfd096e`.`hackbean` WHERE `username` = '$user'"))
		{		
			$row = mysql_fetch_assoc($result);
			
			//If password matches then go for it
			if(strcmp($row['password'], $password) == 0)
			{
				echo "Yes";
			}
		}	
		else
		{
			echo mysql_error();
		}
	}
 	
	//mysql_query("INSERT INTO `heroku_807bde1acfd096e`.`hackbean` (`username`, `password`) VALUES ('Justin', 'test2')");
?>

<html>
	<head>
		<title>InBetween Home</title>
	</head>
	
	<body>
		<form action="index.php" method="post">
			Username: <input type="text" name="username"/><br>
			Password: <input type="password" name="password"/>
			<input type="hidden" name="login"/>
			<input type="submit"/>
		</form>
	</body>
</html>
