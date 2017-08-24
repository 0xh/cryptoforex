jQuery(document).ready(function () {

	var popup = jQuery('.popup');

	jQuery('a').click(function(){
		return false;
	});

	jQuery('.close,.bgc').click(function(){
	    jQuery('.popup,.bgc').fadeOut(700);
	});

	jQuery('#cust_in-sell').click(function(){
	    jQuery('.cust_in-sell,.bgc').fadeIn(700);
	});

	jQuery('#manage').click(function(){
	    jQuery('.manage,.bgc').fadeIn(700);
	});

	jQuery('#customers').click(function(){
	    jQuery('.customers,.bgc').fadeIn(700);
	});

	jQuery('.customers table tbody tr td a').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.history_in-sell,.bgc').fadeIn(700);
	});

	jQuery('.history_in-sell a.back').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.customers,.bgc').fadeIn(700);
	});

	jQuery('#operations').click(function(){
	    jQuery('.operations,.bgc').fadeIn(700);
	});

	jQuery('#waiting').click(function(){
	    jQuery('.waiting,.bgc').fadeIn(700);
	});

	jQuery('#my_diamonds').click(function(){
	    jQuery('.my_diamonds,.bgc').fadeIn(700);
	});

	jQuery('#in_sell').click(function(){
	    jQuery('.in_sell,.bgc').fadeIn(700);
	});

	jQuery('#sold_diamond').click(function(){
	    jQuery('.sold_diamond,.bgc').fadeIn(700);
	});

	jQuery('#user').click(function(){
	    jQuery('.user,.bgc').fadeIn(700);
	});

	jQuery('#leads').click(function(){
	    jQuery('.leads,.bgc').fadeIn(700);
	});

	jQuery('#user_history').click(function(){
	    jQuery('.user_history,.bgc').fadeIn(700);
	});

	jQuery('.new').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.new_user,.bgc').fadeIn(700);
	});

	jQuery('#edit_user').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.edit_user,.bgc').fadeIn(700);
	});

	// jQuery('.user table tbody tr td a').click(function(){
	// 	jQuery('.popup,.bgc').fadeOut(700);
	//     jQuery('.edit_user,.bgc').fadeIn(700);
	// });

	jQuery('#users').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.users,.bgc').fadeIn(700);
	});

	jQuery('#money_transactions').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.popup_money_report,.bgc').fadeIn(700);
	});

	jQuery('#withdrawals').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.widthdtrawal,.bgc').fadeIn(700);
	});

	jQuery('#manage_lots').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.manage_lots,.bgc').fadeIn(700);
	});

	jQuery('#Customers_Investment').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.customer_investments,.bgc').fadeIn(700);
	});

	jQuery('#affiliate').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.new_user,.bgc').fadeIn(700);
	});

	jQuery('#cust_inver').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.import_leads,.bgc').fadeIn(700);
	});

	jQuery('#e-mail').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.popup_email,.bgc').fadeIn(700);
	});

	jQuery('#telephone').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.popup_telephone,.bgc').fadeIn(700);
	});

	jQuery('#users_balans').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.popup_users_balans,.bgc').fadeIn(700);
	});

	jQuery('.buy').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.popup-accept,.bgc').fadeIn(700);
	});

	jQuery('.edit').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.dashboard,.bgc').fadeIn(700);
	});

	jQuery('.back').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.edit,.bgc').fadeIn(700);
	});

	jQuery('.add').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.task_popup,.bgc').fadeIn(700);
	});

	jQuery('.no,.yes').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	});


	jQuery('.leads table tbody tr .del').click(function(){
		jQuery(this).parent().parent().slideUp();
	});

	jQuery('.leads .search form a.del').click(function(){
		jQuery('.leads table tbody tr,.pagination').slideUp();
	});

	jQuery('.cust_in-sell table tbody tr td a').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.history_in-sell,.bgc').fadeIn(700);
	});

	jQuery('.history_in-sell a.back').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
	    jQuery('.cust_in-sell,.bgc').fadeIn(700);
	});

	jQuery('.main .content .item.task a.more').click(function(){
		jQuery('.popup_task,.bgc').fadeIn(700);
	});

	jQuery('a#edit_user').click(function(){
		jQuery('.popup,.bgc').fadeOut(700);
		jQuery('.edit_user,.bgc').fadeIn(700);
	});




	jQuery('.filter').click(function(){
		if ( jQuery('.popup_filter').is(':visible') ) {
			jQuery('.popup_filter').slideUp(700);
		} else {
			jQuery('.popup_filter').slideDown(700);
		}
	    
	});

	jQuery('#notifications').click(function(){
		if ( jQuery('.notifications').is(':visible') ) {
			jQuery('.notifications').slideUp(700);
		} else {
			jQuery('.notifications').slideDown(700);
		}
	    
	});

	jQuery('.source').click(function(){
		if ( jQuery('.popup_source').is(':visible') ) {
			jQuery('.popup_source').slideUp(700);
		} else {
			jQuery('.popup_source').slideDown(700);
		}
	    
	});

	jQuery('.advanced').click(function(){
		if ( jQuery('.popup-search').is(':visible') ) {
			jQuery('.popup-search').slideUp(700);
		} else {
			jQuery('.popup-search').slideDown(700);
		}
	    
	});

});