<?php
	include_once("config.inc");
	$busid = $_GET["id"];
	$time = date('Y/m/d');
	$query = "select * from bus_log where bus_id = $busid  order by time desc;";
	$result = mysql_query($query);
	$rows= array();
	$hour = 1*60*60;
	$oldtime="";
	while($row = mysql_fetch_assoc($result)) {
		$currtime = strtotime($row["time"]);
		if($oldtime == "") $oldtime = $currtime;
		$difference = $currtime - $oldtime;

		if($difference >= $hour) break;
		echo "$difference <br/>";

		$rows[]=$row;
		$oldtime = $currtime;
	}

	//echo json_encode($rows);
?>