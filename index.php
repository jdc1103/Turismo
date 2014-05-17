<?php
	require("php/conexion.php");
	require("php/procesos.php");
	$sql = "SELECT id, nombre, descripcion, img_min FROM sitios ORDER BY id DESC";
	$result = mysql_query($sql);
?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Turismo Nariño</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/index.css">
        <link href="css/estilo_M.css" rel="stylesheet">
	<script src="http://maps.google.com/maps/api/js?sensor=false&language=es"></script>
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

<!-- Buscador de sitios ------------------>
<h4>Localizacion de sitios turisticos </h4>	
        <select onchange="ver();" id="lst1">
                <option>[Seleccione lugar]</option>
             <?php   	
             $sql = "SELECT * FROM sitios ORDER BY id DESC";
             $result = mysql_query($sql);
                while($data = mysql_fetch_array($result)){
                    echo "<option>{$data['nombre']}</option>";
                }
             ?>
        </select>
        <hr>
        <div id="mapa"></div>
<?php

	$sql = "SELECT * FROM sitios ORDER BY id DESC";
	$result = mysql_query($sql);
	echo '        
        <script>
		//https://developers.google.com/maps/documentation/javascript/overlays?hl=es&csw=1
		var map, geocoder;
		geocoder = new google.maps.Geocoder();

		window.onload = function(){
		    var options = {
			zoom: 8, //MAS GRANDE MAS CERCA 
			center: new google.maps.LatLng(1.21358,-77.277957),
			mapTypeId: google.maps.MapTypeId.ROADMAP
			//tipos de mapas SATELLITE TERRAIN
		    };
		    map = new google.maps.Map(document.getElementById("mapa"), options);
		}
	
		function ver(){
		   var latitud = new google.maps.LatLng(1.21358,-77.277957);
		   var mensaje = "";
		   var i = document.getElementById("lst1").selectedIndex;
		   var val = document.getElementById("lst1").value; 
                   var ico = "";   ';
		$i = 0;
		while($data = mysql_fetch_array($result)){
			$i++;
                        if($data['tipo_sitio'] == "religioso"){
                            $ico = "image/ico/religioso.png";
                        }else if($data['tipo_sitio'] == "turistico"){
                            $ico = "image/ico/turistico.png";
                        }else {
				$ico = "image/ico/img3.png";
			}
			echo  " 
			   if (i=={$i}) {
			       //var lat = '{$data['lat']}';
			       //var lon = '{$data['lng']}';
                               mensaje = '{$data['nombre']}';
			       latitud = new google.maps.LatLng{$data['coordenadas']};
                               ico = '{$ico}';
			   }";

		}
		echo '   
		   var marker = new google.maps.Marker({
			position: latitud,
			title: mensaje,
                        icon: ico
		    });
                  
		   //marker.setIcon("imgs/img3.png");
		   marker.setMap(map);
		}
	</script> ';
                ?>
<!--End buscador de sitios ------------>

	<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBwvx8XhEvlSgeH1FHLCJ3F4MU_R8qs-sE&sensor=SET_TO_TRUE_OR_FALSE">
    </script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script src="js/index.js"></script>
</body>
</html>
