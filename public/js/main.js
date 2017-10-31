

jQuery(document).ready(function () {

	var preloader = '#page-preloader';
	jQuery(preloader + ' .spinner-image:nth-of-type(1) img').fadeIn('slow');
	jQuery(preloader + ' .spinner-image:nth-of-type(2) img').delay(1000).fadeIn('slow');
	jQuery(preloader + ' .spinner-image:nth-of-type(3) img').delay(1500).fadeIn('slow');
	jQuery(preloader + ' .spinner-image:nth-of-type(4) img').delay(2000).fadeIn('slow');
	jQuery(preloader + ' .spinner-image:nth-of-type(5) img').delay(2500).fadeIn('slow');
	// jQuery(preloader + ' .spinner-image:nth-of-type(6) img').delay(3000).fadeIn('slow');
	// jQuery(preloader + ' .spinner-image:nth-of-type(7) img').delay(3500).fadeIn('slow');
	jQuery(preloader).delay(3500).fadeOut('slow');

	jQuery('#informer').marquee({
		duration: 7000,
		startVisible: true,
		duplicated: false
	});

	jQuery('.minus').click(function () {
        var $input = jQuery(this).parent().parent().find('input');
        var count = parseInt($input.val()) - 10;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    jQuery('.plus').click(function () {
        var $input = jQuery(this).parent().parent().find('input');
        $input.val(parseInt($input.val()) + 10);
        $input.change();
        return false;
    });

    jQuery('.advance h2').click(function(){
    	if ( jQuery('.advance > ul').is(':visible') ) {
    		jQuery('.advance > ul').fadeOut();
    		jQuery('.advance .right').removeClass('active');
	    	jQuery('.advance .left .item').eq(0).removeClass('active');
	    	jQuery('.advance .left .item').eq(1).removeClass('active');
    	} else {
    		jQuery('.advance > ul').fadeIn();
    		jQuery('.advance .left .item').eq(0).addClass('active');
    	}
    });

    jQuery('.advance > ul li').click(function(){
    	if ( jQuery(this).hasClass('active') ) {
    		jQuery('.advance > ul li').removeClass('active');
    	} else {
    		jQuery('.advance > ul li').removeClass('active');
    		jQuery(this).addClass('active');
    	}
    });

    jQuery('.advance > ul li').eq(0).click(function(){
    	jQuery('.advance .right').removeClass('active');
    	jQuery('.advance .left .item').eq(0).addClass('active');
    	jQuery('.advance .left .item').eq(1).removeClass('active');
    });
    jQuery('.advance > ul li').eq(1).click(function(){
    	jQuery('.advance .right').removeClass('active');
    	jQuery('.advance .left .item').eq(0).removeClass('active');
    	jQuery('.advance .left .item').eq(1).addClass('active');
    });
    jQuery('.advance > ul li').eq(2).click(function(){
    	jQuery('.advance .right').addClass('active');
    	jQuery('.advance .left .item').eq(0).removeClass('active');
    	jQuery('.advance .left .item').eq(1).removeClass('active');
    });

	// jQuery("#informer").liScroll();

	// jQuery( function() {
	//     jQuery( "#slider" ).slider({
	//       value:100,
	//       min: 0,
	//       max: 500,
	//       step: 50,
	//       slide: function( event, ui ) {
	//         jQuery( "#amount" ).val( "$" + ui.value );
	//       }
	//     });
	//     jQuery( "#amount" ).val( "$" + jQuery( "#slider" ).slider( "value" ) );
	//   } );
	  
	// jQuery('.main aside.left .item .inner').mouseover(function(){
	// 	jQuery( this ).find('p.viz').fadeOut(),
	// 	jQuery( this ).find('p.slice').fadeIn()
	// });
	
	jQuery('.main aside.right .deal .tabs_popup .tab_cap .bot a').click(function(){
		jQuery('.popup_open').fadeIn();
		return false;
	});

	jQuery('.popup.popup_open a.order').click(function(){
		jQuery('.popup_close').fadeIn();
		return false;
	});

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

    jQuery('.button').click(function(){
    	if ( jQuery('aside.right').hasClass('see') ) {
    		jQuery('body,.main,.main .content,.main > .container,aside.right').removeClass('see');
    		jQuery(this).removeClass('b_close').addClass('button');
			if ( jQuery('aside.right').hasClass('active') ) {
    			jQuery('.open').removeClass('see');
    			jQuery('.closee').removeClass('see');
    		} else {
    			jQuery('.open').removeClass('see');
    			jQuery('.closee').removeClass('see');
    		}
    	} else {
    		jQuery('body,.main,.main .content,.main > .container,aside.right').addClass('see');
    		jQuery(this).removeClass('button').addClass('b_close');
    		if ( jQuery('aside.right').hasClass('active') ) {
    			jQuery('.open').removeClass('see');
    			jQuery('.closee').addClass('see');
    		} else {
    			jQuery('.open').addClass('see');
    			jQuery('.closee').removeClass('see');
    		}
    	}

    	if ( jQuery('aside.left').hasClass('see') ) {
    		jQuery('body,.main,.main .content,.main > .container,aside.left').removeClass('see');
    		jQuery(this).removeClass('b_close').addClass('button');
			if ( jQuery('aside.left').hasClass('active') ) {
    			jQuery('.open2').removeClass('see');
    			jQuery('.closee2').removeClass('see');
    		} else {
    			jQuery('.open2').removeClass('see');
    			jQuery('.closee2').removeClass('see');
    		}
    	} else {
    		jQuery('body,.main,.main .content,.main > .container,aside.left').addClass('see');
    		jQuery(this).removeClass('button').addClass('b_close');
    		if ( jQuery('aside.left').hasClass('active') ) {
    			jQuery('.open2').removeClass('see');
    			jQuery('.closee2').addClass('see');
    		} else {
    			jQuery('.open2').addClass('see');
    			jQuery('.closee2').removeClass('see');
    		}
    	}
    });

    jQuery('.open').click(function(){
    	jQuery('aside.right').addClass('active');
		jQuery('.content').addClass('active');
		jQuery('.open').removeClass('see');
		jQuery('.closee').addClass('see');
    });

    jQuery('.closee').click(function(){
		jQuery('aside.right').removeClass('active');
		jQuery('.content').removeClass('active');
		jQuery('.closee').removeClass('see');
		jQuery('.open').addClass('see');
	});

	jQuery('.open2').click(function(){
    	jQuery('aside.left').addClass('active');
		jQuery('.content').addClass('active');
		jQuery('.open2').removeClass('see');
		jQuery('.closee2').addClass('see');
    });

	jQuery('.closee2').click(function(){
		jQuery('aside.left').removeClass('active');
		jQuery('.content').removeClass('active');
		jQuery('.closee2').removeClass('see');
		jQuery('.open2').addClass('see');
	});

	// jQuery('a.button').click(function(){
	// 	jQuery('body,.main,.main .content,.main > .container,aside.right').addClass('see');
	// 	jQuery(this).fadeOut();
	// 	jQuery('a.b_close').fadeIn();
	// 	// jQuery('aside.right').addClass('see');
	// 	if ( jQuery('aside.right').hasClass('see') ) {
	// 		jQuery('.open').addClass('see');
	// 		jQuery('.closee').fadeOut();
	// 	} else {
	// 		jQuery('.open').fadeOut();
	// 		jQuery('.closee').fadeIn();
	// 	}
	// 	return false
	// });

	// jQuery('a.b_close').click(function(){
	// 	jQuery('body,.main,.main .content,.main > .container,aside.right').removeClass('see');
	// 	jQuery(this).fadeOut();
	// 	jQuery('a.button').fadeIn();
	// 	jQuery('.open').removeClass('see');
	// 	jQuery('aside.right').removeClass('see');
	// 	if ( jQuery('aside.right').hasClass('see') ) {
	// 		jQuery('.open').addClass('see');
	// 		jQuery('a.closee').fadeIn();
	// 	} else {
	// 		jQuery('.open').fadeOut();
	// 		jQuery('a.closee').fadeOut();
	// 	}
	// 	return false
	// });

	// jQuery('.main .content a.open').click(function(){
	// 	if ( jQuery('aside.right').hasClass('active') ) {
	// 		jQuery(this).removeClass('active');
	// 		jQuery('.content').removeClass('active');
	// 		jQuery( this ).fadeIn();
	// 		jQuery('.closee').fadeOut();
	// 	} else {
	// 		jQuery('aside.right').addClass('active');
	// 		jQuery('.content').addClass('active');
	// 		jQuery( this ).fadeOut();
	// 		jQuery('.closee').fadeIn();
	// 	}
	// });

	// jQuery('.main .content a.closee').click(function(){
	// 	if ( jQuery('aside.right').hasClass('active') ) {
	// 		jQuery(this).removeClass('active');
	// 		jQuery('.content').removeClass('active');
	// 		jQuery( this ).fadeIn();
	// 		jQuery('.closee').fadeOut();
	// 	} else {
	// 		jQuery('aside.right').addClass('active');
	// 		jQuery('.content').addClass('active');
	// 		jQuery( this ).fadeOut();
	// 		jQuery('.closee').fadeIn();
	// 	}


	// });

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
	
	// jQuery('.section .inner .next').click(function(){
	// 	jQuery("body,html").animate({
	// 		scrollTop:0
	// 	},1000);
	// });

	
	jQuery('.section .inner .order').click(function(){
		return
	})

	// var $ = jQuery;


	jQuery('.section .inner').click(function(){ 

		var parent = jQuery(this).parent();
			jQuery(this).addClass('slice').next().slideDown(1000).addClass('active');
		var h = jQuery('.cart .item .back').height();
			h += jQuery('header').height();
			jQuery(this).next().prevAll().each(function(){
			h += jQuery(this).height() + parseInt( jQuery(this).css('padding-top') ) + parseInt( jQuery(this).css('padding-bottom') );
		});
		jQuery('.cart .item').stop().animate({scrollTop: h}, 1000);

		jQuery('.cart ul li').eq(jQuery(this).index()).addClass('active');
		return false;
	});

	// jQuery('.section .inner').click(function(){

	// 	jQuery( this ).next('.inner').slideDown().addClass('active').animate({scrollTop:jQuery(this).height()}, 'slow').index();
	// 	jQuery( this ).addClass('slice').index();

	// 	// jQuery('.inner.active').animate({scrollTop: 0}, 700);
	// 	// jQuery('html, body').animate({scrollTop:jQuery('.inner').height()}, 'slow');

	// 	jQuery('.cart ul li').eq(jQuery(this).index()).addClass('active');

	// 	return false;
	// });

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

		  $('ul.tabs__caption').on('click', 'li.active', function() {
		  	$(this).removeClass('active').closest('div.tabs').find('div.tabs__content').removeClass('active')
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

	jQuery('.tab_cap .box .item.column .inner span').click(function(){
		if ( jQuery( this ).hasClass('active') ) {
			jQuery( '.tab_cap .box .item.column .inner span' ).removeClass('active');
		} else {
			// jQuery('.popup,.bgc').fadeIn();
			jQuery( '.tab_cap .box .item.column .inner span' ).removeClass('active');
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
			jQuery('.notifications').slideUp();
		}
	});

	jQuery(".item li").on("click","a", function (event) {
		var id  = jQuery(this).attr('href'),
			top = jQuery(id).offset().top;
		jQuery('.main .cart .item').eq(0).animate({scrollTop: top}, 1500);
	});

});