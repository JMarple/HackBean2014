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
				$_SESSION['userid'] = $row['ID'];
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
						
					$_SESSION['userid'] = mysql_insert_id();
					$_SESSION['username'] = $user;
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
	if(isset($_POST['SignOut']))
	{
		session_destroy();
		header("Location: index.php");
	}
?>

<html>
	<head>
        <title>HotSpot!</title>
        <link rel="stylesheet" href="styles.css" />
        <script src="modernizr.js"></script>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		
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
					 document.getElementById("yourSearch").value = "Current Location";
					 document.getElementById("yourLat").value = initialLat;
					 document.getElementById("yourLat2").value = initialLat;
					 document.getElementById("yourLong").value = initialLong;
					 document.getElementById("yourLong2").value = initialLong;
					
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
        
        <div id="topbar" width="100%"; > </div>
        
        <div id="login"; ></div>
        
       <!-- <div id="breadcrumb";></div> -->
        
        <div id="box";></div>
        
        
        
        
        <img src="hotspot.png" href="http://secure-waters-3897.herokuapp.com/index.php"      class="logo" alt="HotSpot"> 
     <img src="logintriangle.png" class="triangle">
        <img src="locarrowone.png" class="locarrowone">
        <img src="locarrowtwo.png" class="locarrowtwo">
     <?php if(!isset($_SESSION['loggedin'])){?>  <p><img src="infologo.png" class="infologo" href="registration.php"><span></span></p><?php } ?>s

        
      <!--  <div id="Hotspot";> 
        <p> HotSpot: Bringing People Together </p>
        </div> -->
        

		
            
            
            
		<?php if(!isset($_SESSION['loggedin']))
		{?>
		<form action="index.php" method="post">
            
            <!-- Login code --> 
            
			<input type="text" class="username" placeholder="Username" name="username"/><br>
            <input type="password" class="password" placeholder="Password" name="password"/>
			<input type="hidden" name="login"/>
            <input type="submit" class="login" name="login" > 
            
		</form>
		
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
	<div class="user"> Hello <?php echo $_SESSION['username'];?> </div>
		<br/>
		<form action="index.php" method="post">
			<input type="submit" class="logout" value="(logout)"/>
			<input type="hidden" name="SignOut"/>
		</form>
		<br/><br/>
		<form action="group.php" method="post">
            <input type="submit" class="newgroup" value="New Group"/>
			<input id="yourLat2" type="hidden" name="lat" value=""/>
			<input id="yourLong2" type="hidden" name="long" value=""/>
			<input type="hidden" name="newGroup"/>
		</form>
		<?php 
		} ?>
		<br/><br/>
		
		<br/>
		<br/>
		<form action="find.php" method="post">
		 <?php if(isset($_GET['err'])) echo "Error in search"?><br/>
			<input id="yourSearch" type="text"  placeholder="My Location..." name="search2"/>
			<input type="text" name="search"  placeholder="Their Location..." class="inputtwo"/>
			<input type="submit" class="submitbutton" value="Search"/>
			<input id="yourLat" type="hidden" name="lat"/>
			<input id="yourLong" type="hidden" name="long"/>
			<script>
				
			</script>
		</form>
		<br/><br/>

	</body>
</html>
