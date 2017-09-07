jQuery(document).ready(function () {

	ion.sound({
        sounds: [
            {name: "bell_ring"},
            {name: "door_bell"},
            {name: "branch_break"}
        ],
        path: "sounds/",
        preload: true,
        volume: 1.0
    });


    // jQuery("#b01").on("click", function(){
    //     ion.sound.play("beer_can_opening");
    // });

    jQuery(".b01").on("click", function(){
        ion.sound.play("bell_ring");
    });
    jQuery(".b02").on("click", function(){
        ion.sound.play("door_bell");
    });
    jQuery(".b03").on("click", function(){
        ion.sound.play("branch_break");
    });

	jQuery('a.button').click(function(){
		jQuery('body,.main,.main .content,.main > .container').addClass('see');
		jQuery(this).fadeOut();
		jQuery('a.b_close').fadeIn();
		return false
	});

	jQuery('a.b_close').click(function(){
		jQuery('body,.main,.main .content,.main > .container').removeClass('see');
		jQuery(this).fadeOut();
		jQuery('a.button').fadeIn();
		return false
	});

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

	jQuery('.active_but').click(function(){
		if ( jQuery( this ).hasClass('active') ) {
			jQuery( this ).removeClass('active');
			jQuery( '.main .cart .item:last-child' ).removeClass('active');
		} else {
			jQuery( this ).addClass('active');
			jQuery( '.main .cart .item:last-child' ).addClass('active');
		}
		return false;
	});

	jQuery('.main .cart .item:last-child li').click(function(){
		jQuery( '.main .cart .item:last-child' ).removeClass('active');
		jQuery('.active_but.active').removeClass('active');
	})

	jQuery('.education ul').on('click', 'li:not(.active)', function() {
      $(this).addClass('active').siblings().removeClass('active').parents('.education .box').find('.slide').removeClass('active').slideUp().eq($(this).index()).addClass('active').slideDown();
      return false;
    });

    jQuery('.education ul').on('click', 'li.active', function() {
    	jQuery(this).removeClass('active').parents('.education .box').find('.slide').removeClass('active').slideUp();
    });

	// jQuery('.box .item a').click(function(){

	// 	if ( jQuery( this ).parent().hasClass('active') ) {
	// 		jQuery( '.box .item' ).removeClass('active');
	// 		jQuery( this ).parents().find('.slide').slideUp();
	// 	} else {
	// 		jQuery( '.box .item' ).removeClass('active');
	// 		jQuery( this ).parent().addClass('active').index(this);
	// 		jQuery( this ).parents().find('.slide').eq(jQuery(this).index(this)).slideDown();

	// 		jQuery('html, body').animate({
	// 	        scrollTop: 1000
	// 	    }, 2000);
	// 	}
	// 	return false;
	// });

	// jQuery('.section .inner').on('click', 'a.next', function(){
	
	jQuery('.section .inner .next').click(function(){
		jQuery("body,html").animate({
			scrollTop:0
		},1000);
	});

	
	jQuery('.section .inner .order').click(function(){
		return
	})

	jQuery('.section .inner').click(function(){

		jQuery( this ).next('.inner').slideDown().addClass('active').animate({scrollTop:jQuery(this).height()}, 'slow').index();
		jQuery( this ).addClass('slice').index();

		// jQuery('.inner.active').animate({scrollTop: 0}, 700);
		// jQuery('html, body').animate({scrollTop:jQuery('.inner').height()}, 'slow');

		jQuery('.cart ul li').eq(jQuery(this).index()).addClass('active');

		return false;
	});

	// (function($) {
	// 	$(function() {
	// 	  $('.education ul').on('click', 'li:not(.active)', function() {
	// 	  	$('.education .slide').removeClass('active').slideUp();
	// 	    $(this)
	// 	    	.addClass('active').siblings().removeClass('active')
	// 	    	.closest('.education .box')
	// 	    	.find('.slide')
	// 	    	.removeClass('active').slideUp()
	// 	    	.eq($(this).index())
	// 	    	.addClass('active').slideDown();
	// 	  });

	// 	});
	// 	})(jQuery);

	

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

	(function($) {
		$(function() {

		  $('ul.tabs__cab').on('click', 'li:not(.active)', function() {
		    $(this)
		      .addClass('active').siblings().removeClass('active')
		      .closest('div.tabs').find('div.tab_cab').removeClass('active').eq($(this).index()).addClass('active');
		  });

		});
		})(jQuery);

	jQuery('.deal a.order').click(function(){
		if ( jQuery('.popup_order').is(':visible') ) {
			jQuery('.popup,.bgc').fadeOut();
			jQuery('header').removeClass('active');
			jQuery('nav.nav').fadeIn();
			jQuery('.lang').fadeIn();
		} else {
			jQuery('.popup_order,.bgc').fadeIn();
			jQuery('header').addClass('active');
			jQuery('nav.nav').fadeOut();
			jQuery('.lang').fadeOut();
		}
		return false
	});

	jQuery('a.mail').click(function(){
		if ( jQuery('.notifications').is(':visible') ) {
			jQuery('.notifications').slideUp();
		} else {
			jQuery('.notifications').slideDown();
		}
		return false
	});

	jQuery('.notifications li a').click(function(){
		if ( jQuery('.popup_message').is(':visible') ) {
			jQuery('.popup_message,.bgc').fadeOut();
		} else {
			jQuery('.popup_message,.bgc').fadeIn();
		}
		return false
	});

	jQuery('.bal').click(function(){
		jQuery('.popup_bal,.bgc').fadeIn();
		return false
	});

	jQuery('.bal2').click(function(){
		jQuery('.popup_bal2,.bgc').fadeIn();
		return false
	});
	jQuery('.his').click(function(){
		jQuery('.popup_his,.bgc').fadeIn();
		return false
	});
	jQuery('.cab').click(function(){
		jQuery('.popup_cabinet,.bgc').fadeIn();
		return false
	});

	jQuery('.close,.bgc').click(function(){
		jQuery('.popup,.bgc').fadeOut();
		jQuery('.header').removeClass('active');
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

	jQuery('p.menu').click(function(){
		if ( jQuery(this).hasClass('active') ) {
			jQuery(this).removeClass('active');
			jQuery(this).parents().find('nav').removeClass('active');
		} else {
			jQuery(this).addClass('active');
			jQuery(this).parents().find('nav').addClass('active');
		}
	});

	jQuery(".item li").on("click","a", function (event) {
		var id  = jQuery(this).attr('href'),
			top = jQuery(id).offset().top;
		jQuery('.main .cart .item').eq(0).animate({scrollTop: top}, 1500);
	});

});