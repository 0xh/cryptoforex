jQuery(document).ready(function () {

	jQuery('a').click(function(){
		return false;
	});

	jQuery('#user').click(function(){
	    jQuery('.popup.user').fadeIn(700);
	    jQuery('body').addClass('active');
	});

	jQuery('#edit_user').click(function(){
	    jQuery('.popup.edit_user').fadeIn(700);
	    return false;
	});

	jQuery('.info').click(function(){
	    jQuery('.popup.user_dashboard').fadeIn(700);
	    return false;
	});

	jQuery('#deals').click(function(){
	    jQuery('.popup.deals').fadeIn(700);
	});

	jQuery('#instruments').click(function(){
	    jQuery('.popup.instruments').fadeIn(700);
	});

	jQuery('.new').click(function(){
	    jQuery('.popup.new_user').fadeIn(700);
	});

	jQuery('.filter').click(function(){
		if ( jQuery('.popup_filter').is(':visible') ) {
			jQuery('.popup_filter').slideUp(700);
		} else {
			jQuery('.popup_filter').slideDown(700);
		}

	});

	jQuery('.close').click(function(){
		jQuery(this).parent().fadeOut();
	    // jQuery('body').removeClass('active');
	});

	jQuery('.cancel').click(function(){
		jQuery('.popup').fadeOut();
	});

	(function($) {
		$(function() {

		  $('ul.tabs_in_dashbord').on('click', 'li:not(.active)', function() {
		    $(this)
		      .addClass('active').siblings().removeClass('active')
		      .closest('div.tabs_in').find('div.tabs_in_dash').removeClass('active').eq($(this).index()).addClass('active');
		  });

		});
		})(jQuery);
});