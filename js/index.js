$(function(){
	$('#admSitios').on('click', function(event) {
		event.preventDefault();
		$('.login').toggle('slide');
		$('#user').focus();
	});
	$('#agregar').on('click', function(event) {
		event.preventDefault();
		$('.agregar').toggle("slide")
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
})