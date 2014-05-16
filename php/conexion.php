<?php
	//conectar a db
	$conexion = pg_connect("host='localhost' port='5432' dbname='opif' user='dba' password='123' ");
	
	//estructura de control por si falla
	if(!$conexion){
		die("Error de conexion.".pg_last_error());
	}
?>