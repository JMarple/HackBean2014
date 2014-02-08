<?php 

	require_once "Requests/Requests/library/Requests.php";
	Requests::register_autoloader();
	
	if(isset($_POST['long']))
		$long = $_POST['long'];	
	else	
		$long = "42.34";	
	
	if(isset($_POST['lat']))
		$lat = $_POST['lat'];	
	else
		$lat = "-72.0";
	
	//Get Request
	$request = Requests::get('http://api.tripadvisor.com/api/partner/1.0/map/'.$lat.','.$long.'?key=92C34F58BB4F4E03894F5D171B79857E&limit=50');
	
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

<!DOCTYPE html>
<html>
  <head>
    <title>HotSpot!</title>
      
    <script>
		<?php 
			$js_array = json_encode($data);
			echo "var place = " . $js_array . ";\n";
		?>
    </script>
    
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
      
    <style>
      html, body, #map-canvas {
            
        height: 100%;
        margin: 0px;
        padding: 0px
                
      }
        
    </style>
      
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
      
    <script>
        
var map;
        
function initialize() {
    
  var mapOptions = {
      
    zoom: 8,
    center: new google.maps.LatLng(place[0]['latitude'], place[0]['longitude'])
      
  };
    
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  
  for(var i = 0; i < place.length; i++)
  {

	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(place[i]['latitude'], place[i]['longitude']),
		map: map,
		title: place[i]['name']	
	});
  }
  
}

google.maps.event.addDomListener(window, 'load', initialize);



    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>