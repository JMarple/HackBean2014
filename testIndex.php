<html>
	<head>
		<title>HotSpot!</title>
        <link rel="stylesheet" href="styles.css" />
        <script src="modernizr.js"></script>

	</head>
	
	<body>
        <div id="topbar" width="100%"; > </div>
        
        <div id="logo";>  </div>
        
        <div id="Hotspot";> 
        <p> HotSpot: Bringing People Together </p>
        </div>
        
		<form action="index.php" method="post">
			
			<input type="text" class="username" name="username"/><br>
            <input type="password" class="password" name="password"/>
			<input type="hidden" name="login"/>
			
		</form>
		<br/>
		<br/>
		<form action="index.php" method="post">
            
            <input type="text" class="username" name="username" /><br>
			<input type="password" class="password" name="password"/>
			<input type="hidden" name="CreateAccount"/>
			
		</form>
			<br/>
		<br/>
		<form action="find.php" method="post">
        
            
		
			<input type="text" class="inputone" name="search"/>
			<input type="text" class="inputtwo" name="searchbox"/>
			
            
      
		</form>
	</body>
</html>
