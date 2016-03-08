jQuery( document ).ready(function($) {
   

  $(".right-menu-wrap .fa-envelope").stop().on("click", function() {

  	$(".right-menu-wrap .main_menu").animate({width: 'toggle'}, 100);
  	$(".right-menu-wrap .fa-envelope").toggleClass("icon-white");

  });

    $(".left-menu-wrap .fa-bars").on("click", function() {

  	$(".left-menu-wrap .main_menu").animate({width: 'toggle'}, 100);
  	$(".left-menu-wrap .fa-bars").toggleClass("icon-white");

  });

});