<?php
	require("conexion.php");
	if(isset($_REQUEST["op"])){
		$op = $_REQUEST["op"];
	}else{
		$op = "";
	}

	switch($op){
		case "updateSitio":
			$data = $_REQUEST['data'];
			$sql = "UPDATE sitios SET 
				nombre = '$data[0]',
				ubicacion = '$data[1]',
				temperatura = '$data[2]',
				contacto = '$data[3]',
				coordenadas = '$data[4]',
				descripcion = '$data[5]',
				historia = '$data[6]',
				img_min = '$data[7]',
				tipo_sitio = '$data[8]'
				WHERE id = '$data[9]'";
			echo mysql_query($sql);
			break;
		case "addSitio":
			$data = $_REQUEST['data'];
			$sql = "INSERT INTO sitios (nombre, ubicacion, temperatura, contacto, coordenadas, descripcion, historia, img_min, tipo_sitio)
			VALUES ('$data[0]', '$data[1]', '$data[2]','$data[3]', '$data[4]','$data[5]', '$data[6]', '$data[7]', '$data[8]')";
			mysql_query($sql);
			$result = mysql_query("SELECT MAX(id) AS id from sitios");
			$result = mysql_fetch_row($result);
			$result = $result[0];
			echo mysql_num_rows($result);
			break;
		case "delete":
			$data = $_REQUEST['id'];
			$sql = "DELETE FROM sitios WHERE id = '$data'";
			mysql_query($sql);
			break;
		case "edit":
			$data = $_REQUEST['id'];
			$sql = "SELECT * FROM sitios WHERE id = $data";
			$result = mysql_query($sql);
			echo json_encode(mysql_fetch_array($result));
			break;
		default:
			break;
	}

	function template($id,$imgMin, $titulo, $parrafo){
		$article = '<article id="'.$id.'">
			<figure>
				<img src="image/sitios/'.$imgMin.'" alt="imagen">
			</figure>
			<div class="acciones">
				<a href="#'.$id.'" class="edit"></a>
				<a href="#'.$id.'" class="delete"></a>
			</div>
			<h3>
				'.$titulo.'
			</h3>
			<p>'.$parrafo.'</p>

			<a href="javascript:void(0);" onClick="ver('.$id.');" class="modal moreInfo" url="php/ver_mas.php?id='.$id.'">Mas Información</a><br /><br />

		</article>';
		echo $article;
	}
?>
