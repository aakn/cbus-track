<?php
	include_once("config.inc");
	$lim=$_GET["limit"];
	$table=$_GET["table"];
	if($table != "balance") $table="bus_log";
	if($lim<20) $lim=20;
	$query = "select * from $table order by time,id desc limit $lim;";
	$result = mysql_query($query);
	$rows=array();
	while($row = mysql_fetch_assoc($result)) {
		$rows[] = $row;
		echo json_encode($row)."<br/>";
	}
	//echo json_encode($rows);
?>