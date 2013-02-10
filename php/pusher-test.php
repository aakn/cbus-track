<?php
	include('pusher.inc');
	$lat = 12; $lon = 77; $time = "right now"; $speed = "100"; $bus_id="1";
	$pusher = new Pusher($key, $secret, $app_id);
	$array = array(
		 'bus_id' => $bus_id,
		 'lat'=> $lat, 
		 'lon' => $lon, 
		 'time' => $time ,
		 'speed' => $speed
		 );
	$pusher->trigger('track-channel', 'bus-moved', $array );
?>