<?php

/* Prerequisite functions to load the theme */
require ('core-functions.php');

/**
   *
   * @param The category to get by name
   * @param The post type to get retrieve it from
   * @param The ID of the post
   */
  




function remix_post_author($cat_name) {


$cat_id = get_cat_ID( $cat_name );
  $defaults = array(
'numberposts' => 1,
'category' => $cat_id,
'post_type' => 'post',
);
$latest_post = get_posts( $defaults );
$post_author_id = $latest_post[0]->post_author;

$author_meta = get_the_author_meta('display_name',$post_author_id); 


return $author_meta;


}

function remix_post_title($cat_name) {


$cat_id = get_cat_ID( $cat_name );
  $defaults = array(
'numberposts' => 1,
'category' => $cat_id,
'post_type' => 'post',
);
$latest_post = get_posts( $defaults );
$post_title = substr($latest_post[0]->post_title, 0, 65);

if(strlen($post_title) >= 65) : 

$result = $post_title . "...";
return $result;

else :  

return $post_title;

endif;


}


/**
   *
   * @param string $name Name of the specific section file to use.
   */
  

function get_section( $name = null, $position = null) {

  do_action( 'get_section', $name );

  $templates = array();
  $name = (string) $name;
  if ( '' !== $name ) 
    $templates[] = 'inc/' . $name . '-{$name}' . '.php';

  $templates[] = 'inc/' . $name . '.php';

  // Backward compat code will be removed in a future release
   $file = 'wp-content/themes/remix' . "/" . $templates[1];


   return locate_template($templates, true, false);

}


add_action('init', 'rewrite_tag');
function rewrite_tag(){
// add_rewrite_rule("http://remixmagazine.dev/wp-admin/admin.php", '([0-9]+)/?$');

    add_rewrite_rule(
        'auckland.php?article=([^/]*)',
        'index.php?id=$matches[1]',
        'top' );

}


/**
 *
 *
 * Load more posts
 */

function more_post_ajax(){

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 8;
    $offset = (isset($_POST['offset'])) ? $_POST['offset'] : 16;




    header("Content-Type: text/html");



$args = array(
    'posts_per_page' => 8,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'offset' => $offset,
    'post_status' => 'publish',
    'suppress_filters' => true 

 );

    $loop =  new WP_Query( $args, OBJECT);

    $out = '';
    global $post;

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
        $out .= article($post);

    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}


add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');







