jQuery(document).ready(function($) {


  $(".right-menu-wrap .icon-subscribe").on("hover", function() {
      $(".right-menu-wrap").addClass("menu_slide");
  }); 

  $(".right-menu-wrap").on("mouseleave", function(){
       $(".right-menu-wrap").removeClass("menu_slide");
  });

   $(".left-menu-wrap .fa-bars").on("click", function(){
       $(".left-menu-wrap").toggleClass("left_menu_slide");
       $(".left-menu-wrap").toggleClass("overflow-y");
       $(".left-menu-wrap .icon-subscribe").toggleClass("bars-white");

  });

  $.ajaxSetup({ cache: true });

  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){

    FB.init({
      appId      : '573967432759585',
      xfbml      : true,
      version    : 'v2.5'
    });     

    // $('#loginbutton,#feedbutton').removeAttr('disabled');
    // FB.getLoginStatus(updateStatusCallback);

    $("body").on("click", "#fbshare", function(){
      console.log($(this));

    	 var item = $(this);
    	 
    	 var items = item.data("share").split(',');

    	 var url = items[0];
    	 var title = items[1];
    	 var image = items[2];
       var description = items[3];


//        FB.ui({
//   method: 'share_open_graph',
//   action_type: 'og.likes',
//   action_properties: JSON.stringify({
//     object: url,
//     image: {
//         url: $.trim(image)
//     }
//   })
// }, function(response){
// });



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