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

$(".upload-media").on("click", function(e){
   e.preventDefault();

   open_media_uploader_image();

});


/** slot */


$(".next").on("click", function() {
  if(!$(".create-title").val() || !$(".create-link").val() || !$(".data-image").val()) {
     $(".warning").show();
  } else {
    var location = $("#sel1 option:selected").val();
   $(".advert-creator").addClass("advert-location").removeClass("advert-creator");
   $(".create-advert").hide();
   if(location == "bottom") {
      $(".choose-location-bottom").show();
   } else {
      $(".choose-location").show();
   } 
 }
});

$(".article").on("click", function() {
  $(".article").find(".green-overlay").hide();
  $(this).find(".green-overlay").show();

  var position = $(this).data("position");
  $(".data-position").val(position);
});
});






