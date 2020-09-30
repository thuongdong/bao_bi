/*
* Plugin name: Redsand Jquery Switch Button Plugin
* Author: phannhuthan
* Uri: http://redsand.vn
* Version: 1.0
* Modify date: 20/1/2014
*/

/* param
	options = {
		change: function(value, button, input, event){
			...
		},
		style: 'default' | 'on-off' | 'yes-no',
		cssClass: ''
	}
*/

(function($){
	$.fn.rsSwitch = function(options){
		
	    options = $.extend({
			change: false,
			cssClass: '',
			style: 'default'
		}, options);
		
		this.data('rsSwitch', options);
		
		this.each(function(){
		
			var button = $(this).prev(), input = $(this);
			
		    if (button.length == 0){
		        button = $('<a class="rs-switch-trigger"></a>');
		        $(this).before(button).hide();
		    }

			if(button.closest('.rs-switch').length == 0){
				button.add(input).wrap('<div class="rs-switch rs-switch-' + options.style + ' ' + options.cssClass + '"></div>');
			}
			else{
				button.closest('.rs-switch').addClass('rs-switch-' + options.style).addClass(options.cssClass);
			}
			
		    button.addClass(options.cssClass);
			
			button.toggleClass('on', input.val() == 'on');
			button.toggleClass('off', input.val() != 'on');

			button.unbind('click.rs-switch').bind('click.rs-switch', function(event){
				input.val(input.val() == 'on' ? 'off' : 'on');
				button.toggleClass('on', input.val() == 'on');
				button.toggleClass('off', input.val() != 'on');
				if (options.change) options.change(input.is(':checked'), button, input, event);
			});
		});
		
		return this;
	}
})(jQuery);