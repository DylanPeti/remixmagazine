<?php

/* Prerequisite functions to load the theme */
require ('core-functions.php');

/**
   *
   * @param The category to get by name
   * @param The post type to get retrieve it from
   * @param The ID of the post
   */
  

function remix_thumbnail_url($cat_name = null, $post_type, $id = null) {
if($post_type == "cat") :

$cat_id = get_cat_ID( $cat_name );
  $defaults = array(
'numberposts' => 1,
'category' => $cat_id,
'post_type' => 'post',
);
$latest_post = get_posts( $defaults );
$thumb_id = get_post_thumbnail_id($latest_post[0]->ID);

elseif($post_type == "post") :

$thumb_id = get_post_thumbnail_id($id);
endif;

$post_thumbnail_url = wp_get_attachment_url( $thumb_id );

return $post_thumbnail_url;

}

/**
   *
   * @param string $name Name of the specific section file to use.
   */
  

function get_section( $name = null ) {

  do_action( 'get_section', $name );

  $templates = array();
  $name = (string) $name;
  if ( '' !== $name ) 
    $templates[] = 'inc/' . $name . '-{$name}' . '.php';

  $templates[] = 'inc/' . $name . '.php';

  // Backward compat code will be removed in a future release
  
return locate_template($templates, true, false);

}







