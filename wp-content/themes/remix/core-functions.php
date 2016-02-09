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

