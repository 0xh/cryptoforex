jQuery(document).ready(function(){jQuery(".header .search a").click(function(){return jQuery(".header .search .form").is(":visible")?jQuery(".header .search .form").slideUp():jQuery(".header .search .form").slideDown(),!1}),jQuery("body.home .mobi").click(function(){jQuery(this).hasClass("active")?(jQuery(this).removeClass("active"),jQuery(this).parents().find("nav").removeClass("active")):(jQuery(this).addClass("active"),jQuery(this).parents().find("nav").addClass("active"))}),jQuery("#top").click(function(){jQuery("body,html").animate({scrollTop:0},1e3)}),jQuery(".close,.bgc,.button a").click(function(){return jQuery(".popup,.bgc").fadeOut(),!1}),jQuery(".header .wind .button_scroll,.header nav a,.main nav.bot_nav a").on("click",function(e){var r=jQuery(this).attr("href"),a=jQuery(r).offset().top;return jQuery("body,html").animate({scrollTop:a-50},1500),!1})});