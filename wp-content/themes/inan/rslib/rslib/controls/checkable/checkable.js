jQuery(function($) { 
	$('.rs-checkbox-input, .rs-radio-input').rsCheckAble(); 
	
	$(document).bind('rs-control-rebuild', function(e, box){
		$(box).find('.rs-checkbox-input, .rs-radio-input').rsCheckAble();
	});
});
