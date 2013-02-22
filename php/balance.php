<?php
	include_once("config.inc");
	$bal = $_GET["bal"];
	$bus_id = $_GET["id"];
	

	$time = date('Y/m/d H:i:s');
	$query = "insert into balance (bal,time,bus_id) values ('$bal','$time',$bus_id);";
	echo $query;
	$result = mysql_query($query);
	echo $result;

?>