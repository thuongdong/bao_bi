$(document).ready(function() {
	$('.services-item .readmore').click(function(e){
		e.preventDefault();
		$index = $(this).attr('id');
		$('.services-item').hide();
		$('.' + $index).show().removeClass('col-md-6').addClass('col-md-12').find('.col-md-12').removeClass('col-md-12').addClass('col-md-4').removeClass('col-md-12').addClass('col-md-4').addClass('show-all');
		$('.readmore').hide();
		$('.thu-nho').show();
	});
	$('.services-item .thu-nho').click(function(e){
		e.preventDefault();
		$index = $(this).attr('id');
		$('.services-item').hide().show();
		$('.' + $index).removeClass('col-md-12').addClass('col-md-6').find('.col-md-4').removeClass('col-md-4').addClass('col-md-12').removeClass('show-all');
		$('.thu-nho').hide();
		$('.readmore').show();
	});
	$('.navbar-nav > li').each(function() {
		if($(this).hasClass('dropdown')) {
			$(this).children().next().addClass('dropdown-menu');
		}
	});

	$('.search-box').click (function(event) {
		event.preventDefault();
		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$(this).children().removeClass('fa-times').addClass('fa-search');
			$('.navbar-form').hide();
		} else {
			$(this).addClass('active');
			$(this).children().removeClass('fa-search').addClass('fa-times');
			$('.navbar-form').show();
		}
	});
});
/* ----------------------------------------------------------- */
/*  Fixed header
 /* ----------------------------------------------------------- */

(function() {

	var docElem = document.documentElement,
		didScroll = false,
		changeHeaderOn = 10;
	document.querySelector( 'header' );

	function init() {
		window.addEventListener( 'scroll', function() {
			if( !didScroll ) {
				didScroll = true;
				setTimeout( scrollPage, 250 );
			}
		}, false );
	}

	function scrollPage() {
		var sy = scrollY();
		if ( sy >= changeHeaderOn ) {
			$('.top-page').slideUp(100);
			$("header").addClass("header-fixed");

		}
		else {
			$('.top-page').slideDown(100);
			$("header").removeClass("header-fixed");

		}
		didScroll = false;
	}

	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	init();

})();

jQuery(document).ready(function(e) {jQuery('ul').each(function(){ jQuery(this).find('li:last').addClass('last'); });jQuery('ul').each(function(){ jQuery(this).find('li:first').addClass('first'); });
	var customers_list;
	customers_list = jQuery(".customers-list");
	customers_list.owlCarousel({
		autoplay : true,
		loop:true,
		margin:15,
		nav:true,
		dots: false,
		navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsiveClass:true,
		responsive:{
			320:{
				items:1,
			},
			390:{
				items:2,
			},
			480:{
				items:2,
			},
			600:{
				items:3,
			},
			1000:{
				items:4,
			}
		}
	});
	new WOW().init();
	jQuery(".screen .frame img").mouseover(function() {
		var distance = this.height - jQuery(this).parent().height();
		jQuery(this).stop().animate({marginTop: - distance}, 3000, 'linear');
	}).mouseout(function() {
		jQuery(this).stop().animate({marginTop: '0'}, 300);
	});
	jQuery('.scrollTo').on('click', scrollToTop);
	function scrollToTop() {verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;element = jQuery('body');offset = element.offset();offsetTop = offset.top;jQuery('html, body').animate({scrollTop: offsetTop}, 500, 'linear');}
});