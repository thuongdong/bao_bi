jQuery(function($) {
	$('.rs-menu li:has(ul)').addClass('hassub');
	
	$('.rs-menu > ul > li a[href^=#]').click(function(event){
		event.preventDefault();
		$('.rs-content-main .rs-fields:visible').hide();
		$('.rs-content-main .rs-fields#rs-tab-' + $(this).attr('data-tab-name')).show();
		$('.rs-menu li li.active').removeClass('active');
		if($(this).next('ul').length){
			$('.rs-menu > ul > li.active').not($(this).parent()).removeClass('active').find('ul').slideUp();
			$(this).parent().addClass('active').find('ul').slideDown();
			if($('.rs-content-main .rs-fields#rs-tab-' + $(this).attr('data-tab-name')).length == 0){
				$(this).next().find('li:first > a[href^=#]').click();
				return false;
			}
		}
		else{
			$('.rs-menu > ul > li.active').not($(this).parents('li')).removeClass('active').find('ul').slideUp();
			$(this).parent().parents('li').addClass('active').find('ul').slideDown();
			$(this).parent().addClass('active');
		}
		
		$('.rs-form').css('min-height', $('.rs-menu').height() + 60);
		$(window).trigger('scroll');
		
		rs_make_breadcrumb();
	});
	
	$('.rs-menu > ul > li:first > a[href^=#]').click();
	
	$('.rs-form').css('min-height', $('.rs-menu').height() + 60);
	
	$(window).scroll(function(){
		var wh = $(window).height();
		var wt = $(window).scrollTop();
		var ch = $('.rs-form').height();
		var ct = $('.rs-form').offset().top;
		var fh = $('.rs-form-action').outerHeight();
		var ft = wh + wt - fh - ct;

		if(ft < ch){
			$('.rs-form-action').css({top: ft, marginTop: 0});
		}
		else{
			$('.rs-form-action').css({top: '100%', marginTop: '-60px'});
		}
	});
	
	$(window).resize(function(){
		$(window).trigger('scroll');
	});
	
	$('.rs-form form').submit(function(event){
		$('.rs-form-action .spinner').show();
		if($(this).has(':file').length == 0){
			event.preventDefault();
			if(!$('.rs-form-action .rs-button').is('.disabled')){
				$('.rs-form-action .rs-button').addClass('disabled');
				var url = $(this).attr('action');
				var params = $(this).serialize();
				$.post(url, params, function(data){
					$('.rs-form-action .spinner').hide();
					$('.rs-form-action .rs-button').removeClass('disabled');
					message('Settings saved.');
				}).error(function(){
					message('Error');
				});
			}
		}
	});
	
	$('.rs-msg').delay(10000).slideUp(400, function(){
		jQuery(window).trigger('scroll');
	});
	
	$('.rs-panel-wrap h2:first').remove();
	
	$('a[href=#]').click(function(event){ event.preventDefault() });
	
	$(window).trigger('scroll');
});

function rs_make_breadcrumb(){
	jQuery('.rs-breadcrumb li:gt(0)').hide();
	jQuery('.rs-menu > ul > li.active > a').each(function(){
		jQuery('.rs-breadcrumb li.rs-breadcrumb-e2 a').text(jQuery(this).text()).parent().show();
	});
	jQuery('.rs-menu li  li.active > a').each(function(){
		jQuery('.rs-breadcrumb li.rs-breadcrumb-e3 a').text(jQuery(this).text()).parent().show();
	});
}