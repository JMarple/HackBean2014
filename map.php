<?php 

	require_once "Requests/Requests/library/Requests.php";
	Requests::register_autoloader();
	
	$lat1 = $_POST['lat1'];
	$long1 = $_POST['long1'];
	$lat2 = $_POST['lat2'];
	$long2 = $_POST['long2'];
	
	if(isset($_POST['midLong']))
		$midLong = $_POST['midLong'];	
	else	
		$midLong = "42.34";	
	
	if(isset($_POST['midLat']))
		$midLat = $_POST['midLat'];	
	else
		$midLat = "-72.0";
	
	//Get Request
	$request = Requests::get('http://api.tripadvisor.com/api/partner/1.0/map/'.$midLat.','.$midLong.'?distance=25&key=92C34F58BB4F4E03894F5D171B79857E&limit=50');
	
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
	    zoom: 10,
	    center: new google.maps.LatLng(place[0]['latitude'], place[0]['longitude'])
	  };
	    
	  map = new google.maps.Map(document.getElementById('map-canvas'),
	      mapOptions);

	  //Info window variable
	  var infowindow =  new google.maps.InfoWindow({
           content: ""
      });

      //Loop through all the markers
	  for(var i = 0; i < place.length; i++)
	  {
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(place[i]['latitude'], place[i]['longitude']),
			map: map,
			title: place[i]['name']	
		});

		$content = "<div style='font-size: 18px'>" + place[i]['name'] + "</div>" + 
		"<img src='http://maps.googleapis.com/maps/api/streetview?size=250x250&location="+place[i]['latitude']+","+place[i]['longitude']+"&fov=90&heading=235&pitch=10&sensor=false'/>" 
			;
		//Bind Info window and marker
		bindInfoWindow(marker, map, infowindow, $content);
	  }
	  
	  drawYou();
	  
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);

	//Closer loop fix
	function bindInfoWindow(marker, map, infowindow, strDescription) {
	    google.maps.event.addListener(marker, 'click', function() {
	        infowindow.setContent(strDescription);
	        infowindow.open(map, marker);
	    });
	}


	
		function drawYou()
		{
		  var pinColor = "7777FF";
		  var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
			        new google.maps.Size(21, 34),
			        new google.maps.Point(0,0),
			        new google.maps.Point(10, 34));
	
		  new google.maps.Marker({
			  position: new google.maps.LatLng(<?php echo $lat1?>,  <?php echo $long1?>),
			  map: map,
			  icon: pinImage,
			  title: "Person 1"
		  });
		  
		  new google.maps.Marker({
			  position: new google.maps.LatLng(<?php echo $lat2?>,  <?php echo $long2?>),
			  map: map,
			  icon: pinImage,
			  title: "Person 2"
		  });

		  new google.maps.Circle({
				strokeColor: '#7777FF',
				strokeOpacity: 0.6,
				strokeWeight: 2,
				fillColor: '#7777FF',
				fillOpacity: 0.15,
				map:map,
				center: new google.maps.LatLng(<?php echo $lat1?>, <?php echo $long1?>),
				radius: 500
			  });	

		  new google.maps.Circle({
				strokeColor: '#7777FF',
				strokeOpacity: 0.6,
				strokeWeight: 2,
				fillColor: '#7777FF',
				fillOpacity: 0.15,
				map:map,
				center: new google.maps.LatLng(<?php echo $lat2?>, <?php echo $long2?>),
				radius: 500
			  });	  
		}

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>