<?php
	require("php/conexion.php");
	require("php/procesos.php");
	$sql = "SELECT id, nombre, descripcion, img_min FROM sitios";
	$result = mysql_query($sql);
?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Turismo Nariño</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/index.css">
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
			<li><a href="#" id="admSitios">Administrar sitios</a></li>
			<li><a href="#" id="agregar">Agregar sitio</a></li>
		</ul>
	</nav>
	<div class="agregar">
		<form action="">
			<div class="datosSitio">
				<p>
					<label for="nombre">nombre</label>
					<input type="text" id="nombre">
				</p>
				<p>
					<label for="ubicación">Ubicación</label>
					<input type="text" id="ubicación">
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
					<input type="text" id="coordenadas"  min="1" max="40">
				</p>
			</div>
			<div class="historia">
				<textarea id="descripcion" rows="4" cols="30" placeholder="Escribe algo sobre este nuevo sitio"></textarea>
				<textarea id="historia" rows="4" cols="30" placeholder="Cuentanos la historia del sitio que deseas crear"></textarea>
			</div>
			<div class="mapaC">
				<div id="mapaAgregar"></div>
			</div>
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
			while($data = mysql_fetch_array($result)){
				template($data['id'], $data['img_min'],$data['nombre'],$data['descripcion']);
			}
		 ?>
	</section>
	<section class="mapaGeneral">
		<div class="map_canvas"></div>
		<input type="text" placeholder="Sitios registrados">
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