$(document).ready(function(){
	$(".banners.owl-carousel").owlCarousel({
		animateOut: 'fadeOut',
		autoplay: true,
		items: 1,
		loop: true
	});

	$('.types-of-vehicles ul li a').hover(
	    function() {
	    	var category_type = $(this).data('category_type');
	    	var category_wise_products = $('div.vehicles.'+category_type).html();
	    	$('div.vehicles.random').html(category_wise_products);
	    	
	        $(this).children('img').removeClass('hidden');
	        $(this).children('img:first-child').addClass('hidden');
	    },
	    function() {
	        $(this).children('img').addClass('hidden');
	        $(this).children('img:first-child').removeClass('hidden');
	    }
	);

	/*$('.media-center .row.absolute > div img').click(function(){
		var src = $('.media-center .col-md-7 img').attr('src');
		$('.media-center .col-md-7 img').attr('src', $(this).attr('src'));
		$('.media-center .col-md-7 img').parent('a').attr('href', $(this).attr('src'));
		$(this).attr('src', src);
		$(this).parent('a').attr('href', src);
	});*/

	$('.product .tab-link').click(function(e){
		e.preventDefault();
		$('.tab-link').removeClass('active');
		$(this).addClass('active');
		$('.tab-content').addClass('hidden');
		$($(this).attr('href')).removeClass('hidden');
	});

	$('.product #gallery a.thumb').click(function(e){
		e.preventDefault();
		$('.product #gallery a.thumb').removeClass('active');
		$(this).addClass('active');
		$('.gallery-image').attr('src', $(this).attr('href'));
	});

	$('.product #gallery .next-image').click(function(){
		if(!$('.product #gallery a.thumb.active').parent().is(':last-child')){
			$('.product #gallery a.thumb.active').parent().next().children('.thumb').click();
		}
	});

	$('.product #gallery .prev-image').click(function(){
		if(!$('.product #gallery a.thumb.active').parent().is(':first-child')){
			$('.product #gallery a.thumb.active').parent().prev().children('.thumb').click();
		}
	});

	$('.products .product-list .hidden-xs .thumbnail .caption > div').each(function(){
		if($(this)[0].offsetHeight < $(this)[0].scrollHeight){
			var href = $(this).siblings('h3').children().attr('href');
			$(this).append('<a href="' + href + '" class="read-more">Read More <i class="fa fa-angle-right" aria-hidden="true"></i></a>');
		}
	});

	/*$(function() {
        $(this).on('contextmenu', function(e) {
            e.preventDefault();
        });
    });*/

});