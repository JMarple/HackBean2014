<!DOCTYPE html>
<html>
  <head>
      <title>HotSpot!</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true">
    </script>
    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(21.854, 4.987),
          zoom: 8
        };
          
          
     var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
 
    // info window test      
        
    var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"> Test Header</h1>'+
      '<div id="bodyContent">'+
      '<p>This is a test info Window</p>'+
      '</div>';
          
          
      var infowindow = new google.maps.InfoWindow({
          
      content: contentString
          
      });
          
      var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: ' Justin is Sexy '
      });
          
          
      google.maps.event.addListener(marker, 'click', function() {
      
      infowindow.open(map,marker);
      
      });


          
              
      });
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map-canvas"/>
  </body>
</html>