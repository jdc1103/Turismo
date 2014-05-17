<?php
	$conexion = mysql_connect("localhost","root","holamundo") or die ('No he podido conectar: '.mysql_error());
	mysql_select_db("turismo",$conexion);
?>
