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
			if(strcmp($row['password'], crypt($password, $row['password'])) == 0)
			{
				echo "Yes";
			}
			else
			{
				echo "no";
			}
		}	
		else
		{
			echo mysql_error();
		}
	}
	/* CREATE ACCOUNT */
	if(isset($_POST['CreateAccount']))
	{
		//Terribly insecure way to log in, to be changed
		$user = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		
		//Try to find usernames that already exist
		if($result = mysql_query("SELECT username FROM `heroku_807bde1acfd096e`.`hackbean` WHERE `username` = '$user'"))
		{
			//If Username is unique
			if(mysql_num_rows($result) == 0)
			{
				//If Password is valid (not null and hasn't changed through the escape process
				if(strcmp($password,"" ) != 0 && strcmp($password, $_POST['password'])==0)
				{	
					//Crypt Password and send 
					$password = crypt($password);
					mysql_query("INSERT INTO `heroku_807bde1acfd096e`.`hackbean` (`username`, `password`) VALUES ('$user', '$password')")
						or die(mysql_error());
				}
				else
				{
					echo "Invalid Password";
				}
			}
			else
			{
				echo "Username already being used";
			}
		}
	}
?>

<html>
	<head>
		<title>HotSpot!</title>
        <link rel="stylesheet" href="styles.css" />
	</head>
	
	<body>
		<form action="index.php" method="post">
			Log in <br/>
			Username: <input type="text" name="username"/><br>
			Password: <input type="password" name="password"/>
			<input type="hidden" name="login"/>
			<input type="submit"/>
		</form>
		<br/>
		<br/>
		<form action="index.php" method="post">
			Create New Account <br/>
			Username: <input type="text" name="username"/><br>
			Password: <input type="password" name="password"/>
			<input type="hidden" name="CreateAccount"/>
			<input type="submit"/>
		</form>
			<br/>
		<br/>
		<form action="find.php" method="post">
		Search:
			<input type="text" class="input" name="search"/><br/>
			<input type="text" class="input" name="dumbyBox"/>
			<input type="submit"/>
		</form>
	</body>
</html>
