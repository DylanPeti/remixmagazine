<?php
use MetzWeb\Instagram\Instagram;

$class = "Remix";

function get_hero() {
  
  global $class;

  $heros = $class::read("hero");

  $post = array();

  foreach ($heros as $hero ) :

  	$post[] = get_post($hero->post_id);

  endforeach;

  return $post;

}


function get_articles() {

   global $class; 

   $article = $class::read("article")[0];
 
   if($article->page == "Home") :

   	    $type = $article->type;

   	    return $type($article->count);

   endif;

}


function get_instagram($id = 'self', $limit = 0) {



  $class = "Remix";

  $social = $class::read("social")[0];
  
  $instagram = new Instagram(array(
    'apiKey'      => $social->app_key,
    'apiSecret'   => $social->app_secret,
    'apiCallback' => $social->app_callback
  ));
  
  if(isset($social->access_token)) {

  $instagram->setAccessToken($social->access_token);

  $result = $instagram->getUserMedia('self', 10);

  $url = $result->data;
  
  $thumb = array(); 
  
  foreach($url as $link) {
   
   $thumb[] = $link->images->standard_resolution->url;
  
  } 

  $img = array_chunk($thumb, 5); 
 return $img;

  }

}



function the_latest_posts($count) {

      $do_not_duplicate = array();

	  $args = array('numberposts' => 10);

	  $posts = wp_get_recent_posts( $args, OBJECT );
      
      $do_not_duplicate[] = (isset($duplicates[0]) ? $duplicates[0] : false);
      $do_not_duplicate[] = (isset($duplicates[1]) ? $duplicates[1] : false);
      $do_not_duplicate[] = (isset($duplicates[2]) ? $duplicates[2] : false);

      $new_args = array('numberposts' => $count, 'post__not_in' => $do_not_duplicate);

      $items = wp_get_recent_posts( $new_args, OBJECT );

      $result = $items;
  
	  return $result;
}


function the_latest_from_categories($count) {

	$categories = array("fashion", "beauty", "culture", "lifestyle", "#soulsundaysessions",
		                 "#notatourist", "outandabout", "Research");
    $cat_ids = array();

    foreach($categories as $cat) :

      $cat_ids[] = get_cat_ID($cat);

    endforeach;
    
    $compact_cats = array(implode(',',$cat_ids));

    $args = array('include' => $compact_cats[0], 'taxonomy' => 'category');
   
    $post = get_categories( $args );

    $result = $items;
   
    return $result;

}












