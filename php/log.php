<?php
	include_once("config.inc");
	$coord = $_GET["text"];
	$bus_id = $_GET["id"];
	$balance = $_GET["bal"];
	$v = $_GET["v"];
	$speed = $_GET["speed"];
	

	if($v == "A") $valid = "YES";
	else $valid = "NO";
	
	list($lat, $lon) = split('\$',$coord);
	$oldlat = $lat;
	$oldlon = $lon;
	$oldspeed = $speed;

	$speed = $speed * 1.852;
	// set the default timezone to use. Available since PHP 5.1
	date_default_timezone_set('Asia/Calcutta');

	$NS = substr($lat, -1);
	$EW = substr($lon, -1);

	$lat = substr($lat, 0, -1);
	$lon = substr($lon, 0, -1);

	if($NS == 'S') 
		$lat = '-'.$lat;

	if($EW == 'W') 
		$lon = '-'.$lon;

	$lat = convert($lat);
	$lon = convert($lon); 

	$time = date('Y-m-d H:i:s');
	$query = "insert into bus_log (lat,lon,time,speed,bus_id,bal,valid) values ('$lat','$lon','$time','$speed',$bus_id,'$balance','$valid');";
	//echo $query;
	$result = mysql_query($query);
	echo $result;

	include('pusher.inc');
	$pusher = new Pusher($key, $secret, $app_id);
	$array = array(
		'bus_id' => $bus_id,
		 'lat'=> $lat, 
		 'lon' => $lon, 
		 'time' => $time ,
		 'speed' => $speed
		 );
	// $pusher->trigger('track-channel', 'bus-moved', $array );
	$base_url = 'track.pesseacm.org';
	if ($balance == "") $balance = "BALANCEFAIL";
	//$ch = curl_init("django.insigniadevs.com/add/1/1253.8802N/07735.3015E/50/A/e$is$45.43$INR.Valid/");
	$url = "$base_url/add/$bus_id/$oldlat/$oldlon/$oldspeed/$v/$balance/";
	// echo "<br/>$url<br/>";
	$ch = curl_init($url);
	curl_exec($ch);
	curl_close($ch);



	function convert($coord) {
		list($deg, $second) = split('\.',$coord);

		$minute = substr($deg,-2);

		$deg = substr($deg, 0, -2);

		$second = ".".$second;
		$second = $second*60;
		
		return DMStoDEC($deg, $minute, $second);
	}
	function DMStoDEC($deg, $min, $sec)
	{
		// Converts DMS ( Degrees / minutes / seconds ) 
		// to decimal format longitude / latitude

	    return $deg+( (($min*60) + ($sec)) /3600);
	} 
?>
