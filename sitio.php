<?php
	require("php/conexion.php");
	require("php/procesos.php");
	$id = $_GET['id'];
	$sql = "SELECT * FROM sitios WHERE id = '$id'";
	$result = mysql_query($sql);
?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Turismo Nariño</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sitio.css">
</head>
<body>
	<header>
		<div class="logo">
			<img src="image/logo.png" alt="logo de la empresa">
		</div>
		<h1>Aqui deben colocar un buen titulo</h1>
		<h3>Una breve descripcion del sitio</h3>
	</header>
	<nav>
		<ul class="menu">
			<!-- <li><a href="#" id="admSitios">Administrar sitios</a></li> -->
			<li><a href="#" id="guardar">Guardar PDF</a></li>
			<li><a href="#" id="agregar">Agregar sitio</a></li>
		</ul>
	</nav>
	<div class="agregar">
		<form action="" id="agregarSitio">
			<div class="datosSitio">
				<p>
					<label for="nombre">nombre</label>
					<input type="text" id="nombre">
				</p>
				<p>
					<label for="ubicación">Ubicación</label>
					<input type="text" id="ubicacion">
				</p>
				<p>
					<label for="temperatura">Temperatura</label>
					<input type="number" id="temperatura"  min="1" max="40">
				</p>
				<p>
					<label for="contacto">Contacto</label>
					<input type="text" id="contacto"  min="1" max="40">
				</p>
				<p>
					<label for="coordenadas">Coordenadas</label>
					<input type="text" id="coordenadas" placeholder="Haz click en el mapa" min="1" max="40">
				</p>
				<p>
					<label for="tiposSitio">Tipo sitio</label>
					<select name="" id="tiposSitio">
						<option value="1">Religioso</option>
						<option value="2">Turistico</option>
						<option value="3">Otro</option>
					</select>
				</p>
			</div>
			<div class="historia">
				<textarea id="descripcion" rows="4" cols="30" placeholder="Escribe algo sobre este nuevo sitio"></textarea>
				<textarea id="historia" rows="4" cols="30" placeholder="Cuentanos la historia del sitio que deseas crear"></textarea>
				<input type="submit" value="Guardar">
			</div>
			<div class="mapaC">
				<div id="mapaAgregar"></div>
			</div>
		</form>
		<form id="uploadImg" class="formImg" action="php/upload.php" method="post" enctype="multipart/form-data" target="hiddenIframe">
			<label for="imgMin" >Cargar Foto</label>
			<input type="file" id="imgMin" name="Filedata">
			<img src="" class="thumbnail">
		</form>
	</div>
	<form action="" class="login">
		<p>
			<label for="user">Usuario</label>
			<input type="text" id="user" value="admin">
		</p>
		<p>
			<label for="password">Contraseña</label>
			<input type="password" id="password" value="admin">
		</p>
		<input type="submit" value="Iniciar">
	</form>
	<section class="sitios">
		<?php 
			$data = mysql_fetch_array($result)
		 ?>
		<article>
			<h3 class="titulo"><?php echo $data['nombre'] ?></h3>
			<h4>Descripcion</h4>
			<p class="descripcion"><?php echo $data['descripcion'] ?></p>
			<h4>Historia</h4>
			<p class="historia"><?php echo $data['historia'] ?></p>
		</article>
		<div class="info">
			<span class="temperatura"><?php echo $data['temperatura']."º"?></span>
			<span class="contacto"><?php echo $data['contacto'] ?></span>
		</div>
	</section>
	<section class="mapaGeneral">
		<figure>
			<img src=<?php echo '"image/sitios/'.$data["img_min"]. '"'?> alt="">
		</figure>
		<div class="mapaSitio">
			<div id="gMap"></div>
		</div>
		<iframe id="hiddenIframe" style="display: none;"></iframe>
	</section>
	<footer>
		<h3>
			IU. CESMAG
		</h3>
	</footer>
	<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBwvx8XhEvlSgeH1FHLCJ3F4MU_R8qs-sE&sensor=SET_TO_TRUE_OR_FALSE">
    </script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script src="js/index.js"></script>
</body>
</html>
