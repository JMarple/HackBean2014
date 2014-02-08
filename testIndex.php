<html>
	<head>
		<title>HotSpot!</title>
        <link rel="stylesheet" href="styles.css" />
        <script src="modernizr.js"></script>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	</head>
	
	<body>
        <div id="topbar" width="100%"; > </div>
        
        <div id="login"; ></div>
        
        <div id="breadcrumb";></div>
        
        
        <img src="hotspot.png" class="logo" alt="HotSpot"> 
        <img src="logintriangle.png" class="triangle">
        <img src="locarrowone.png" class="locarrowone">
        <img src="locarrowtwo.png" class="locarrowtwo"> 
        
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
