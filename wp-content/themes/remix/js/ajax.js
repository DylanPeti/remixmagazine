jQuery(document).ready(function($) {

var ppp = 8; // Post per page
var cat = 1;





$(document).scroll(function() {
var mouse = $(document).scrollTop();
var load_position = $(".article-collection-bottom").position().top - $(".article-collection-bottom").height();



});


function load_posts(){


	var offset = $("#more-posts").data('offset');
   
    var str = '&offset=' + offset + '&ppp=' + ppp + '&action=more_post_ajax';

    $("#more-posts").show();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function(data){
            var $data = $(data);
            if($data.length){
                 $("#more-posts").hide();
                $(".article-collection-bottom").append($data);
                $(".advert-overlay").css("display", "none");
                $("#more-posts").attr("disabled",false);
            } else{
                $("#more-posts").attr("disabled",true);
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }    

    });
    return false;
}






   
   $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height() ){
        	var offset = $("#more-posts").data('offset');

          var append = offset + 8;
          $("#more-posts").data('offset', append);
           load_posts();
   
        }
   

});
   });













