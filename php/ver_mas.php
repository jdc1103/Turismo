<html> <?php   require_once("conexion.php"); ?>
<head>
</head>
<body bgcolor="#f4f4f4">
<div style="font-family:Comic Sans MS,arial,verdana; font-size: 13px;text-align: justify;">
<?php
//id: parametro de busqueda sitio
$id = $_GET['id']; ?>
<div style="text-align: right"><a href="php/reportes/tcpdf/reports/reporte.php?id=<?php echo $id; ?>">Guardar Información</a></div>

    <?php
	$sql = "SELECT * FROM sitios WHERE id = $id";
	$result = mysql_query($sql);
	while($data = mysql_fetch_array($result)){

		echo "<h3 align='center'>{$data['nombre']}</h3>
			  <h4>Aqui imgs...</h4>			  
			  <h4>Historia</h4>
			  <p>{$data['historia']}</p>
			  <h4>Descripción</h4>
			  <p>{$data['descripcion']}</p>
			<table cellspacing='3'  cellpadding='3' border='1' align='center'>
				<tr>	
					<td align='center'>Temperatura</td>	
					<td align='center'>Atractivo</td>
					<td align='center'>Ubicación</td>
					<td align='center'>Contacto</td>
				</tr>
				<tr>	
					<td align='center'>{$data['temperatura']}</td>	
					<td align='center'> {$data['tipo_sitio']} </td>
					<td align='center'>{$data['ubicacion']}</td>
					<td align='center' 	>{$data['contacto']}</td>
				</tr>
			</table>
		";
		
	}
?>
</div>
</body>
</html>
