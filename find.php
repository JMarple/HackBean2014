<?php 

	require_once "Requests/Requests/library/Requests.php";
	Requests::register_autoloader();
	
	//Get Request
	$request = Requests::get('http://api.tripadvisor.com/api/partner/1.0/map/42.34,-72.08?key=92C34F58BB4F4E03894F5D171B79857E&limit=50');
	
	//Convert to array
	$obj = json_decode($request->body, true);
	
	$data;
	
	//Go through each object and get data
	foreach($obj['data'] as $value)
	{
		//var_dump($value);
		echo $value['name'];
		echo "<br/>Latitude:";
		echo $value['latitude'];
		echo "<br/>Longitude";
		echo $value['longitude'];
		echo "<br/><br/>";
	}
?>