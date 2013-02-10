<?php
	include_once("config.inc");
	$query = "select * from bus_log;";
	$result = mysql_query($query);
	$rows=array();
	while($row = mysql_fetch_assoc($result)) {
		$rows[] = $row;
		echo json_encode($row)."<br/>";
	}
	//echo json_encode($rows);
?>