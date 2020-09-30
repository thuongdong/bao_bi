jQuery(function($) { 

	$(document).bind('rs-control-rebuild.rs-colorpicker', function(e, box){
		$(box).find('.rs-colorpicker-trigger').ColorPicker({
			color: $(this).prev().val(),
			onSubmit: function(hsb, hex, rgb, el){
				$(el).ColorPickerHide();
			},
			onShow: function (colpkr) {
				$(colpkr).css({'left': '-=184', 'top': '+=4'}).stop(true,false).fadeIn(500);
				if(parseInt($(colpkr).css('left')) < $(this).prev().offset().left){
					$(colpkr).css('left', $(this).prev().offset().left);
				}
			},
			onHide: function (colpkr) {
				$(colpkr).stop(true,false).fadeOut(500);
			},
			onChange: function (hsb, hex, rgb) {
				$($(this).data('colorpicker').el).prev().val('#' + hex);
				$($(this).data('colorpicker').el).css('background', '#' + hex);
			}
		}).each(function(){
			$(this).ColorPickerSetColor($(this).prev().val());
			$(this).css('background', $(this).prev().val());
		});
		
		$(box).find('.rs-colorpicker-trigger').prev().change(function(){
			var hex = $.Color($(this).val()).toHexString();
			$(this).val(hex);
			$(this).next().css('background', hex).ColorPickerSetColor(hex);
		});
	});
	
	$(document).trigger('rs-control-rebuild.rs-colorpicker', '.rs-colorpicker');
});
