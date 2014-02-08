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
        <div id="topbar" width="100%" height="40px";> </div>
        
		<form action="index.php" method="post">
			
			<input type="text" class="login" name="username"/><br>
            <input type="password" class="login" name="password"/>
			<input type="hidden" name="login"/>
			
		</form>
		<br/>
		<br/>
		<form action="index.php" method="post">
            
            <input type="text" name="username"/><br>
			<input type="password" name="password"/>
			<input type="hidden" name="CreateAccount"/>
			
		</form>
			<br/>
		<br/>
		<form action="find.php" method="post">
        
            
		
			<input type="text" class="input" name="search"/><br/>
			<input type="text" class="input" name="search2"/>
			
            
      
		</form>
	</body>
</html>
