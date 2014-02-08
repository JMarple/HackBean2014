<?php 

	if(isset($_POST['search']))
	{
		require_once "Requests/Requests/library/Requests.php";
		Requests::register_autoloader();
		
		$search = $_POST['search'];
		
		//Get Request
		$request = Requests::get('http://api.tripadvisor.com/api/partner/1.0/search/'.$search.'?category=geos&key=92C34F58BB4F4E03894F5D171B79857E&limit=50');
		
		//Convert to array
		$obj = json_decode($request->body, true);
		
		if(!isset($obj['geos'][0]))
			header("Location: index.php?err=s");

		$longitude = $obj['geos'][0]['longitude'];
		$latitude = $obj['geos'][0]['latitude'];
		
		$yourLat = $_POST['lat'];
		$yourLong = $_POST['long'];
		
		$midLong = ($longitude + $yourLong)/2;
		$midLat = ($latitude + $yourLat)/2;
		//$data;
		
		//$i = 0;
		//Go through each object and get data
		/*foreach($obj['data'] as $value)
		{
			$data[$i]['name'] = $value['name'];
			$data[$i]['latitude'] = $value['latitude'];
			$data[$i]['longitude'] = $value['longitude'];
			
			$i++;
		}*/
	}
	else
	{
		header("Location: index.php");
	}
?>

<form action="map.php" method="post" name="frm">
	<input type='hidden' name='midLong' value="<?php echo $midLong; ?>"/>
	<input type='hidden' name='midLat' value="<?php echo $midLat; ?>"/>
	<input type='hidden' name='long1' value="<?php echo $yourLong; ?>"/>
	<input type='hidden' name='lat1' value="<?php echo $yourLat; ?>"/>
	<input type='hidden' name='long2' value="<?php echo $longitude; ?>"/>
	<input type='hidden' name='lat2' value="<?php echo $latitude; ?>"/>
</form>

<script language="JavaScript">
	document.frm.submit();
</script>