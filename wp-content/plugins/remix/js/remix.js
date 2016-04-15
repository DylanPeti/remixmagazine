jQuery( document ).ready(function($) {

var media_uploader = null;

function open_media_uploader_image()
{
    media_uploader = wp.media({
        frame:    "post", 
        state:    "insert", 
        multiple: false
    });

    media_uploader.on("insert", function(){
        var json = media_uploader.state().get("selection").first().toJSON();

        var image_url = json.url;
        var image_caption = json.caption;
        var image_title = json.title;

        $(".preview").addClass("preview-advert-image");

        $(".data-image").val(image_url);

        $(".preview").css("background-image", 'url(' + image_url + ')');
    });

    media_uploader.open();
}

$(".upload-media").on("click", function(){
   

   open_media_uploader_image();

});


/** slot */

$(".slot").on("click", function() {
 $(".slot").removeClass("tick");

 $(this).addClass("tick");

 var position = $(this).data("pos");

 $(".pos-number").html(position);
 $(".data-position").val(position);

});



});