$(document).ready(function(){

	$('#remove_this_item').click(function(){
		$(this).parent().fadeOut(500);
	});

	$('#remove_this_it').click(function(){
		$(this).parent().fadeOut(500);
	});
	
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	
});