jQuery(function($){
	$(document).bind('rs-control-rebuild.rs-switch', function(e, box){
		$(box).find('.rs-switch-input').each(function(){
			$(this).rsSwitch();
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-switch', '.rs-switch');
});