$(function(){
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
function placeMarker(location, map) {
	 marker = new google.maps.Marker({
		position: location,
		map: map
	});
	
	$('#coordenadas').val(location);
}