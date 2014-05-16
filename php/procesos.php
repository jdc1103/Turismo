<?php
	require("conexion.php");
	if(isset($_REQUEST["op"])){
		$op = $_REQUEST["op"];
	}else{
		$op = "";
	}

	switch($op){
		case "article":
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
