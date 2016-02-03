<?php
/**
*
* Load scripts
* Minify everything
*/
function remix_js_scripts() {
  wp_enqueue_style( 'remix_css', get_stylesheet_uri() );
  wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
if( is_front_page() ) {

/* js */

// wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/remix.js', array('jquery') );
wp_enqueue_script('bootstrapJS', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery') );
wp_enqueue_script('remix_js', get_template_directory_uri() . '/js/remix.js', array('bootstrapJS') );
/* css */

}
if( is_category() ) {
  wp_enqueue_script();
}
if( is_single() ) {
  wp_enqueue_script();
}
}
add_action ('wp_enqueue_scripts', 'remix_js_scripts');
/**
*
* Add theme support for following items
*/
function remix_theme_support() {
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
register_nav_menus( array(
    'primary' => __( 'Primary Menu',      'remix' ),
  ) );
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
  ) );
add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
  ) );
add_theme_support( 'post-thumbnails', array('post', 'page', 'category') );
  set_post_thumbnail_size( 825, 510, true );

}
add_action( 'after_setup_theme', 'remix_theme_support' );
/**
* [remix_widgets_init description]
* @return remix sidebars
*/
function remix_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Widget Area', 'remix' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Add widgets here to appear in your sidebar.', 'remix' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}


add_action( 'widgets_init', 'remix_widgets_init' );

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

function carousel($items) { ?>

<div class="container"> 
<article class="article-carousel">
  <div id="myCarousel" class="carousel slide article-carousel-box" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="col-md-4">
          <img src="<?php echo remix_thumbnail_url('', 'post', $item->ID) ?>">
        </div>
      </div>
      <?php foreach ($items as $item) : ?>
      <div class="item article-carousel-item">
        <div class="col-md-4">
          <img src="<?php echo remix_thumbnail_url('', 'post', $item->ID) ?>" />
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
    
  </div>
</article>

</div>

<?php } ?>

<?php 

function article_loop() {
  
}



