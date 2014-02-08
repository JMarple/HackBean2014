<?php 

	require_once "Requests/Requests/library/Requests.php";
	Requests::register_autoloader();
	
	//Get Request
	$request = Requests::get('http://api.tripadvisor.com/api/partner/1.0/map/42.34,-72.08?key=92C34F58BB4F4E03894F5D171B79857E&limit=50');
	
	//Convert to array
	$obj = json_decode($request->body, true);
	
	$data;
	
	$i = 0;
	//Go through each object and get data
	foreach($obj['data'] as $value)
	{
		$data[$i]['name'] = $value['name'];
		$data[$i]['latitude'] = $value['latitude'];
		$data[$i]['longitude'] = $value['longitude'];
		
		$i++;
	}
?>