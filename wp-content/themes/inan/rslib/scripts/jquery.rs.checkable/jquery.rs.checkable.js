/*
* Plugin name: Redsand Jquery Custom Check Able Control
* Author: phannhuthan
* Uri: http://redsand.vn
* Version: 3.3
* Last modify: 8/12/2014
*/

/* param
	
	options = {
		change: function(event, ui = {checked, helper}){
			...
		}
	}
	
*/

(function($){
	$.fn.rsCheckbox = $.fn.rsRadio = $.fn.rsCheckAble = function(options){
	
		options = $.extend({ 
			change: false,
			text: ""
		}, options);
	
		this.filter(':checkbox, :radio').each(function(){			
			var type = $(this).is(':checkbox') ? 'checkbox' : 'radio';
			var checkbox = $(this);
			var helper = checkbox.next('.rs-' + type + '-trigger').removeClass('checked');
			var label = checkbox.closest('label');
			
			if(helper.length == 0){
				helper = $('<a class="rs-' + type + '-trigger">' + options.text + '</a>');
				checkbox.after(helper);
			}
			
			if(helper.closest('.rs-' + type).length == 0 && helper.parent().is('label')){
				helper.parent().addClass('rs-' + type);
			}
			
			checkbox.css({
				position: 'absolute',
				left: -9999
			});
			
			helper.addClass(checkbox.attr('class')).addClass(checkbox.is(':checkbox') ? 'rs-checkbox' : 'rs-radio');
			
			if(checkbox.is(':checked')) helper.add(label).addClass('checked');
			
			if(checkbox.is(':disabled')) helper.add(label).addClass('disabled');
			
			helper.unbind('click').click(function(event){
				event.preventDefault();
				if (!checkbox.is(':disabled')) {
				    checkbox.get()[0].click();
				}
			});	
			
			checkbox.unbind('change.rs-checkable').bind('change.rs-checkable', function (event) {
			    if (checkbox.is(':radio')) {
			        var name = checkbox.attr('name');
			        if (checkbox.closest('form').length > 0) {
			            checkbox.closest('form').find('[name="' + name + '"]').removeAttr('checked').next().removeClass('checked');
			        }
			        else {
			            $('[name="' + name + '"]').removeAttr('checked').next().removeClass('checked');
			        }
					checkbox.attr('checked', 'checked');
			    }
				var checked = checkbox.is(':checked');
			    helper.add(label).toggleClass('checked', checked);
			    
				if (typeof options.change == 'function') options.call(checkbox, event, {checked: checked, helper: helper});
			});
		});
		return this;
	}
}(jQuery));