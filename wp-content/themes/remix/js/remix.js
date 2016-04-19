jQuery(document).ready(function($) {

$(document).scroll(function() {
var mouse = $(document).scrollTop();
var activate = $("#toolbar-section").position().top + $("#toolbar-section").height();
if(mouse > activate) {
      $(".top-toolbar").addClass("top-toolbar-active").animate({opacity: 1}, 2000);

  $(".logo-header").css("margin-top", "44px");
} else {
  $(".top-toolbar").removeClass("top-toolbar-active", 500);
   $(".logo-header").css("margin-top", "0px");
}
});


   $(".fa-bars").on("click", function(){
       $(".left-menu-wrap .slider-content").toggleClass("show");
       $(".left-menu-wrap").toggleClass("left-menu-wrap-active");
  });


  $(".fa-envelope").on("click", function(){
    $(".right-menu-wrap .slider-content").toggleClass("show");
  });

  $.ajaxSetup({ cache: true });

  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){

    FB.init({
      appId      : '573967432759585',
      xfbml      : true,
      version    : 'v2.5'
    });     


    $("body").on("click", "#fbshare", function(){

    	 var item = $(this);
    	 
    	 var items = item.data("share").split(',');

    	 var url = items[0];
    	 var title = items[1];
    	 var image = items[2];
       var description = items[3];




    FB.ui({
        display: 'popup',
        method: 'share_open_graph',
        action_type: 'Share',
        action_properties: JSON.stringify({
        	object: {
          url: url,
            title: title,
            description: description,
            image: {
              url: $.trim(image),
            }
          }
    })
  }, function(response){
});

  });

});
  });