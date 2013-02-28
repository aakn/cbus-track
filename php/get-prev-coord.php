<?php
	include_once("config.inc");
	$busid = $_GET["id"];
	$time = date('Y/m/d H:i:s');
	$query = "select * from bus_log where bus_id = $busid and time = '$time' order by time desc;";
	$result = mysql_query($query);
	$rows= array();
	while($row = mysql_fetch_assoc($result)) {
		//echo json_encode($row);
		$rows[]=$row;
	}

	echo json_encode($rows);
?>