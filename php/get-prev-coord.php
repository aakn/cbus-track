<?php
	include_once("config.inc");
	$busid = $_GET["id"];
	$time = date('Y/m/d');
	$query = "select * from bus_log where bus_id = $busid and time like '$time%' order by time desc;";
	$result = mysql_query($query);
	$rows= array();
	$oldtime1;
	while($row = mysql_fetch_assoc($result)) {
		//$currtime = strtotime($row["time"]);
		//echo "$currtime <br/>";
		$rows[]=$row;
	}

	echo json_encode($rows);
?>