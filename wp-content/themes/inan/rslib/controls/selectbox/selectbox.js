jQuery(function($) { 
	$('.rs-selectbox').rsSelectBox(); 
		
	$(document).bind('rs-control-rebuild', function(e, box){
		$(box).find('.rs-selectbox').rsSelectBox();
	});
});