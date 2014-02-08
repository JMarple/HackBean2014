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
				$_SESSION['username'] = $row['username'];
				$_SESSION['loggedin'] = true;
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
						
					$_SESSION['username'] = $row['username'];
					$_SESSION['loggedin'] = true;
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
		<title>InBetween Home</title>
   		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
		<script>
			var initialLong = 0;
			var initialLat = 0;

			function initialize() {

			  // Try W3C Geolocation (Preferred)
			  if(navigator.geolocation) {
			    browserSupportFlag = true;
			    navigator.geolocation.getCurrentPosition(function(position) 
					{
			      	initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			    	 initialLat = position.coords.latitude;
					 initialLong = position.coords.longitude;
					 document.getElementById("yourSearch").value = "Geolocation Found";
					 document.getElementById("yourLat").value = initialLat;
					 document.getElementById("yourLong").value = initialLong;
					
			    }, function() {
			      handleNoGeolocation(browserSupportFlag);
			    });
			  }
			  // Browser doesn't support Geolocation
			  else {
			    browserSupportFlag = false;
			    handleNoGeolocation(browserSupportFlag);
			  }
			
			  function handleNoGeolocation(errorFlag) {
			    if (errorFlag == true) {
			      alert("Geolocation service failed.");
			      initialLocation = newyork;
			    } else {
			      alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
			      initialLocation = siberia;
			    }
			    
			  }
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</head>
	
	<body>
		<?php if(!isset($_SESSION['loggedin']))
		{?>
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
		<?php }
		else 
		{ ?>
		Signed in as : <?php echo $_SESSION['username'];
		} ?>
		<br/>
		<form action="find.php" method="post">
		Search: <?php if(isset($_GET['err'])) echo "Error in search"?><br/>
			<input id="yourSearch" type="text" name="search2"/><br/>
			<input type="text" name="search"/>
			<input type="submit"/>
			<input id="yourLat" type="hidden" name="lat"/>
			<input id="yourLong" type="hidden" name="long"/>
			<script>
				
			</script>
		</form>
	</body>
</html>
