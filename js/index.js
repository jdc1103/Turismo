var mapG, lat, lng;
window.onload = function(){
	loadGMap();
}
$(function(){
	var name;
	var img;
	$('#admSitios').on('click', function(event) {
		event.preventDefault();
		$('.login').toggle('slide');
		$('#user').focus();
	});
	$('#agregar').on('click', function(event) {
		event.preventDefault();
		$('.agregar').toggle("slide",function(){
			initialize();
		});
	});
	$('#listMaps').on("change", function(){
		var cad = $(this).val();
		var pos = cad.indexOf(',');
		var lat = cad.substring(1,pos);
		var lng = cad.substring(pos+1,cad.length-1);
		console.log(lat,lng);
		loc = new google.maps.LatLng(lat,lng);
		console.log(loc);
		placeMarker(loc, mapG);
	});
	$('#imgMin').on("change", function(event){
		var file = event.target.files; 
		var reader = new FileReader();
		name = file[0].name;
	    reader.onload = function (e) {
	    	img = e.target.result;
			$('.thumbnail').attr("src",e.target.result);
	    };
		reader.readAsDataURL(file[0]);
	})
	$('#agregarSitio').on('submit', function(event){
		event.preventDefault();	
		var variables = new Array();

		$('#uploadImg').submit();
		variables.push($('#nombre').val());
		variables.push($('#ubicacion').val());
		variables.push($('#temperatura').val());
		variables.push($('#contacto').val());
		variables.push($('#coordenadas').val());
		variables.push($('#descripcion').val());
		variables.push($('#historia').val());
		variables.push(name);
		console.log(JSON.stringify(variables));
		$.post('php/procesos.php',{op:"addSitio", data:variables}, function(data, textStatus, xhr) {
			ext = name.substring(name.length -3);
			console.log(ext);
			template(data, name, variables[0], variables[5]);
			$('#agregarSitio input').val();
		});
	})
	$('.login').on('submit', function(event){
		event.preventDefault();
		var user = $('#user').val();
		var password = $('#password').val();
		if(user == 'admin' && password == 'admin'){
			$('.login').hide('slide');
			$('.acciones').show('blind');
			$('#agregar').show();
		}else{
			alert("Algo fallo\nVerifica tu nombre de usuario o contraseña");
		}
	})
});

function loadGMap() {
	var mapOptions = {
		center: new google.maps.LatLng(1.212169, -77.363719),
		zoom: 8,
		streetViewControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	};
	mapG = new google.maps.Map(document.getElementById("gMap"),mapOptions);
}

var marker = new google.maps.Marker;
function initialize() {
	var mapOptions = {
		center: new google.maps.LatLng(1.212169, -77.363719),
		zoom: 9,
		streetViewControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP 
	};
	var map = new google.maps.Map(document.getElementById("mapaAgregar"),mapOptions);
	google.maps.event.addListener(map, 'click', function(event) {
		marker.setMap(null);
		placeMarker(event.latLng, map);
	});
}
function placeMarker(location, map2) {
	console.log(location, map2);
	 marker = new google.maps.Marker({
		position: location,
		map: map2
	});
	$('#coordenadas').val(location);
	lat = location.A;
}

function template(id,imgMin, titulo, parrafo){
	var article = '<article><figure> <img src="image/sitios/'+imgMin+'" alt="imagen"> </figure> <div class="acciones"> <a href="#'+id+'" class="editar"></a> <a href="#'+id+'" class="borrar"></a> </div> <h3> '+titulo+'</h3> <p>'+parrafo+'</p> <a href="#'+id+'" class="moreInfo">Mas información</a> </article>'; 
	$('.sitios').prepend(article);
}
