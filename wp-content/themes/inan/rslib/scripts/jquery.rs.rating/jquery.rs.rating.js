/*
* Plugin name: Redsand Jquery Rating Plugin
* Author: phannhuthan
* Uri: http://redsand.vn
* Version: 2.0
* Modify date: 20/1/2014
*/

/* param
	options = {
        length: 5,
		step: 1,
		starWidth: 26,
		starHeight: 24,
		maxRates: 1,
		type: 1,
		change: function(value, rater, star, slide){
			...
		}
	}
*/

(function($){
	$.fn.rsRating = function(value, options){
		
	    if (isNaN(value)) {
	        if (options == undefined) {
	            options = value;
	        }
	    }
	    else {
	        this.val(value);
	        if (options == undefined) {
	            options = this.data('rsRating');
	        }
	    }       

	    options = $.extend({
			length: 5,
			step: 1,
			starWidth: 26,
			starHeight: 24,
			maxRates: 1,
			change: false,
			type: 1			
		}, options);
		
		if(typeof options.starHeight != 'number' || typeof options.starWidth != 'number') {
			throw "Width and height of star must be a number.";
			return false;
		}
		
		options.width = options.starWidth *options.length;
		
		var stepw = options.starWidth * options.step;
		
		this.data('rsRating', options);
		
		this.each(function(){
		
		    var rater, star, slide, val = $(this).val();

		    if ($(this).is('.rs-rater-hidden')) {
		        rater = $(this).prev();
		        star = rater.find('.rs-rater-star');
		        slide = rater.find('.rs-rater-slide');
		    }
		    else {
		        rater = $('<span class="rs-rater"></span>');

		        star = $('<span class="rs-rater-star"></span>');

		        slide = $('<span class="rs-rater-slide"></span>');

		        rater.append(star).append(slide);
		        $(this).before(rater).hide().addClass('rs-rater-hidden');
		    }

		    rater.addClass('rs-rater-' + options.starWidth + 'x' + options.starHeight);

			var maxRates = options.maxRates;
			
			rater.add(star).add(slide).height(options.starHeight);
			
			rater.width(options.starWidth * options.length);			
			
			rater.css({ display: 'inline-block', position: 'relative'});
			
			star.width(options.starWidth * val).css({ position: 'absolute'});
			
			slide.css({ position: 'absolute'});
			
			rater.unbind('mousemove.rs-rater').bind('mousemove.rs-rater', function(event){
				if(maxRates > 0){
					var x = event.pageX - rater.offset().left;
					if(x > 0 ) x = x + stepw - x % stepw;				
					if(x > options.width) x = options.width;
					slide.width(x);
					if(options.type == 1) star.hide();
				}
			});
			
			rater.unbind('mouseover.rs-rater').bind('mouseover.rs-rater', function(event){
				if(maxRates > 0){
					var x = event.pageX - rater.offset().left;
					if(x > 0 ) x = x + stepw - x % stepw;				
					if(x > options.width) x = options.width;
					slide.width(x);
					if(options.type == 1) star.hide();
				}
			});
			
			rater.unbind('mouseout.rs-rater').bind('mouseout.rs-rater', function (event) {
				if(maxRates == options.maxRates){
					slide.width(0);
				}
				else{
					slide.width(options.starWidth * val);
				}
				if(options.type == 1) star.show();
			});
			
			rater.unbind('click.rs-rater').bind('click.rs-rater', function(){
				if(maxRates >0){
					val = slide.width() / options.starWidth;
					$(this).next().val(val);	
					if(options.type == 1) star.width(slide.width());				
					if(options.change) options.change(val, rater, star, slide);
					maxRates--;
				}
			});
		});
		
		return this;
	}
})(jQuery);