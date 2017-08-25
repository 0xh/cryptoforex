jQuery(document).ready(function () {

	jQuery('.main aside.left ul li .item').slideUp(0);
	jQuery('.main aside.left ul li').eq(0).addClass('active').find('.item').slideDown();

	jQuery('.main aside.left ul li a').click(function(){
		if ( jQuery( this ).parent().hasClass('active') ) {
			jQuery( '.main aside.left ul li' ).removeClass('active').find('.item').slideUp();
			jQuery( this ).parent().find('.item').slideUp();
		} else {
			jQuery( '.main aside.left ul li' ).removeClass('active').find('.item').slideUp();
			jQuery( this ).parent().addClass('active');
			jQuery( this ).parent().find('.item').addClass('active').slideDown();
		}
		return false;
	});

	(function($) {
		$(function() {

		  $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
		    $(this)
		      .addClass('active').siblings().removeClass('active')
		      .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
		  });

		});
		})(jQuery);

	(function($) {
		$(function() {

		  $('ul.tab_item').on('click', 'li:not(.active)', function() {
		    $(this)
		      .addClass('active').siblings().removeClass('active')
		      .closest('div.tabs_popup').find('div.tab_cap').removeClass('active').eq($(this).index()).addClass('active');
		  });

		});
		})(jQuery);

	jQuery('.deal a.order').click(function(){
		if ( jQuery('.popup').is(':visible') ) {
			jQuery('.popup,.bgc').fadeOut();
			jQuery('header').removeClass('active');
		} else {
			jQuery('.popup,.bgc').fadeIn();
			jQuery('header').addClass('active');
		}
		return false
	});

	jQuery('.close,.bgc').click(function(){
		if ( jQuery('.popup').is(':visible') ) {
			jQuery('.popup,.bgc').fadeOut();
			jQuery('header').removeClass('active');
		} else {
			jQuery('.popup,.bgc').fadeIn();
		}
		return false
	});

	jQuery('.popup .tabs_popup .tab_cap .box .item.column .inner span').click(function(){
		if ( jQuery( this ).hasClass('active') ) {
			jQuery( this ).removeClass('active');
		} else {
			jQuery('.popup,.bgc').fadeIn();
			jQuery( this ).addClass('active');
		}
		return false
	});

	// jQuery('.img-carousel').owlCarousel({
	//     loop:true,
	//     nav:true,
	//     responsive:{
	//         0:{
	//             items:1
	//         },
	//         1000:{
	//             items:1
	//         }
	//     }
	// });

  	// jQuery(".tel").mask("+7 (999) 999-9999");

	// jQuery('.fancybox-thumbs').fancybox();

	jQuery(window).scroll(function(){
        var s = jQuery(this).scrollTop();
        if(s > jQuery('.header').height()){
        	jQuery('#top').fadeIn(700);
        }else{
        	jQuery('#top').fadeOut(700);
        }
    });

	jQuery('#top').click(function(){
		jQuery("body,html").animate({
			scrollTop:0
		},1000);
	});

	jQuery('.mobi').click(function(){
		if ( jQuery(this).hasClass('active') ) {
			jQuery(this).removeClass('active');
			jQuery(this).parents().find('nav').removeClass('active');
		} else {
			jQuery(this).addClass('active');
			jQuery(this).parents().find('nav').addClass('active');
		}
	});

	// jQuery("nav li").on("click","a", function (event) {
	// 	var id  = jQuery(this).attr('href'),
	// 		top = jQuery(id).offset().top;
	// 	jQuery('body,html').animate({scrollTop: top + 20}, 1500);
	// });

});