<?php
	include_once("config.inc");
	$busid = $_GET["id"];
	if($_GET["debug"]) $debug = true;
	$time = date('Y/m/d');
	$query = "select * from bus_log where bus_id = $busid and time like '$time%' order by time desc;";
	$result = mysql_query($query);
	$rows= array();
	$hour = 1*60*60;
	$oldtime="";
	while($row = mysql_fetch_assoc($result)) {
		$currtime = strtotime($row["time"]);
		if($oldtime == "") $oldtime = $currtime;
		$difference = $oldtime - $currtime;

		if($difference >= $hour) break;
		if($debug)
			echo "$difference >= $hour<br/>";

		$rows[]=$row;
		$oldtime = $currtime;
	}
	if(!$debug)
		echo json_encode($rows);
?>