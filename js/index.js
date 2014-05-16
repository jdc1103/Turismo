$(function(){
	$('a').on('click', function(event) {
		$('.acciones').show();
		event.preventDefault();
	});
})