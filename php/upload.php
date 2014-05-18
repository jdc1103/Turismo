<?php
	$uploadDir = "../image/sitios/";
	$archivo = $_FILES['Filedata']['name'];
	$extension = substr($archivo, -4);
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadDir."/".$archivo);
	// move_uploaded_file($_FILES['Filedata']['tmp_name'], $uploadDir."img".$extension);
?>