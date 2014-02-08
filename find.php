<?php 

	require_once "Requests/Requests/library/Requests.php";
	Requests::register_autoloader();
	
	$request = Requests::get('http://api.tripadvisor.com/api/partner/1.0/search/boston+restaurants?key=92C34F58BB4F4E03894F5D171B79857E');
	
	//var_dump($request);
	$obj = json_decode($request->body, true);
	
	foreach($obj as $value)
	{
		echo $value[0]['location_string'];
		echo "<br/>";
	}
?>