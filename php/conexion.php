<?php
	$conexion = mysql_connect("localhost","root","") or die ('No he podido conectar: '.mysql_error());
	mysql_select_db("turismo",$conexion);
?>
