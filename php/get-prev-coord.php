<?php
	include_once("config.inc");
	$busid = $_GET["id"];
	$query = "select * from bus_log where bus_id = $busid order by time desc limit 50;";
	$result = mysql_query($query);
	$rows= array();
	while($row = mysql_fetch_assoc($result)) {
		//echo json_encode($row);
		$rows[]=$row;
	}

	echo json_encode($rows);
?>