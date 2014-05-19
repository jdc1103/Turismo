var map, mapG, lat, lng, idAux;
var edit = false;
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
		edit = false;
		$('.agregar').toggle("slide",function(){
			initialize();
		});
	});
	$('.sitios').on('click','.edit, .delete', function(){
		var id = $(this).prop("hash").substring(1);
		var op = $(this).prop("class");
		var res;
		if(op == "delete"){
			res = confirm("Realmente desea eliminar este sitio");
			if (res == true) {
				$.post('php/procesos.php', {op: op, id:id}, function(data) {
					$('#'+id).hide("slide",function(){
						$('#'+id).remove();
					});
				});
			};
		}else{
			$.post('php/procesos.php', {op: op, id:id}, function(data) {
				edit = true;
				var data = JSON.parse(data);
				idAux = data['id'];
				console.log(idAux);
				$('#nombre').val(data['nombre']);
				$('#ubicacion').val(data['ubicacion']);
				$('#temperatura').val(data['temperatura']);
				$('#contacto').val(data['contacto']);
				$('#coordenadas').val(data['coordenadas']);
				$('#historia').val(data['historia']);
				$('#descripcion').val(data['descripcion']);

				var cad = data['coordenadas'];
				var pos = cad.indexOf(',');
				var lat = cad.substring(1,pos);
				var lng = cad.substring(pos+1,cad.length-1);
				loc = new google.maps.LatLng(lat,lng);
				placeMarker(loc, map, $('#listMaps option:selected').attr('name'));
			});
			$('.agregar').show('slide');
			initialize();
		}
		
	});
	$('#listMaps').on("change", function(){
		var cad = $(this).val();
		var pos = cad.indexOf(',');
		var lat = cad.substring(1,pos);
		var lng = cad.substring(pos+1,cad.length-1);
		loc = new google.maps.LatLng(lat,lng);
		placeMarker(loc, mapG, $('#listMaps option:selected').attr('name'));
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
		variables.push($('#nombre').val());  		// 0
		variables.push($('#ubicacion').val());		// 1
		variables.push($('#temperatura').val());	// 2
		variables.push($('#contacto').val());		// 3
		variables.push($('#coordenadas').val());	// 4
		variables.push($('#descripcion').val());	// 5
		variables.push($('#historia').val());		// 6
		variables.push(name);						// 7
		variables.push($('#tiposSitio option:selected').text());	// 8
		variables.push(idAux)											// 9

		if (edit == true) {
			$.post('php/procesos.php',{op:"updateSitio", data:variables}, function(data, textStatus, xhr) {
				ext = name.substring(name.length -3);
				act = actualizaTemplate(data, name, variables[0], variables[5]);
				$('#'+idAux).html(act);
				$('#agregarSitio input').val();
			});
		}else{
			$.post('php/procesos.php',{op:"addSitio", data:variables}, function(data, textStatus, xhr) {
				ext = name.substring(name.length -3);
				template(data, name, variables[0], variables[5]);
				$('#listMaps').prepend('<option name="'+variables[8]+'" value="'+variables[4]+'">'+variables[0]+'</option>');
				$('#agregarSitio input').val();
			});
		}
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
	map = new google.maps.Map(document.getElementById("mapaAgregar"),mapOptions);
	google.maps.event.addListener(map, 'click', function(event) {
		marker.setMap(null);
		placeMarker(event.latLng, map);
	});
}
function placeMarker(location, map2, ico) {
	icon = ico || "";
	if(icon != ""){
		icon = "image/ico/"+ico+".png";
	}
	marker = new google.maps.Marker({
		position: location,
		map: map2,
		icon: icon
	});
	$('#coordenadas').val(location);
}

function template(id,imgMin, titulo, parrafo){
	var article = '<article id="'+id+'"><figure> <img src="image/sitios/'+imgMin+'" alt="imagen"> </figure> <div class="acciones"> <a href="#'+id+'" class="edit"></a> <a href="#'+id+'" class="delete"></a> </div> <h3> '+titulo+'</h3> <p>'+parrafo+'</p> <a href="#'+id+'" class="moreInfo">Mas información</a> </article>'; 
	$('.sitios').prepend(article);
}
function actualizaTemplate(id,imgMin, titulo, parrafo){
	var article = '<figure> <img src="image/sitios/'+imgMin+'" alt="imagen"> </figure> <div class="acciones"> <a href="#'+id+'" class="edit"></a> <a href="#'+id+'" class="delete"></a> </div> <h3> '+titulo+'</h3> <p>'+parrafo+'</p> <a href="#'+id+'" class="moreInfo">Mas información</a>'; 
	return article;
}
