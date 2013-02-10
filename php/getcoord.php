<?php
	include_once("config.inc");
	$busid = $_GET["id"];
	$query = "select * from bus_log where bus_id = $busid order by time desc limit 1;";
	$result = mysql_query($query);
	
	$row = mysql_fetch_object($result);
	echo json_encode($row);
	
	//echo json_encode($rows);
?>