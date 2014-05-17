<?php
	require("conexion.php");
	if(isset($_REQUEST["op"])){
		$op = $_REQUEST["op"];
	}else{
		$op = "";
	}

	switch($op){
		case "addSitio":
			$data = $_REQUEST['data'];
			$sql = "INSERT INTO sitios (nombre, ubicacion, temperatura, contacto, coordenadas, descripcion, historia)
			VALUES ('$data[0]', '$data[1]', '$data[2]','$data[3]', '$data[4]','$data[5]', '$data[6]')";
			mysql_query($sql);
			$result = mysql_query("SELECT * FROM sitios");
			echo mysql_num_rows($result);
			break;
		default:
			break;
	}

	function template($id,$imgMin, $titulo, $parrafo){
		$article = '<article>
			<figure>
				<img src="image/sitios/'.$imgMin.'" alt="imagen">
			</figure>
			<div class="acciones">
				<a href="#'.$id.'" class="editar"></a>
				<a href="#'.$id.'" class="borrar"></a>
			</div>
			<h3>
				'.$titulo.'
			</h3>
			<p>'.$parrafo.'</p>
			<a href="#'.$id.'" class="moreInfo">Mas información</a>
		</article>';
		echo $article;
	}
?>
