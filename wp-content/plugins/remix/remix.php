<?php
global $remix_db_version;
$remix_db_version = '1.0';
/*
Plugin Name: Remix
Plugin URI:  http://#
Description: Remix functionality
Version:     1.5
Author:      Dylan Peti
Author URI:  http://#
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: Remix
*/
// defined( 'ABSsPATH' ) or die( 'No script kiddies please!' );




define("PATH", __FILE__);
define( 'REMIX_PLUGIN_PATH', __dir__ );
define("REMIX_BASE_URL", get_site_url());


/**
 * Proper way to enqueue scripts and styles.
 */



function remix_register_styles() {

    wp_register_style('remix_plugin',"/wp-content/plugins/remix/css/style.css" );
    wp_register_style('remix_plugin_articles',"/wp-content/plugins/remix/css/article.css" );
    $actual_link = "$_SERVER[REQUEST_URI]";
    if(strpos($actual_link, 'remix')) {
    wp_register_style('admin_boot', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); 
    }
    wp_register_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); 
   
}

if( is_admin() ) {
    function my_admin_load_styles_and_scripts() {
        $mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';
        $modes = array( 'grid', 'list' );
        if ( isset( $_GET['mode'] ) && in_array( $_GET['mode'], $modes ) ) {
            $mode = $_GET['mode'];
            update_user_option( get_current_user_id(), 'media_library_mode', $mode );
        }
        if( ! empty ( $_SERVER['PHP_SELF'] ) && 'upload.php' === basename( $_SERVER['PHP_SELF'] ) && 'grid' !== $mode ) {
            wp_dequeue_script( 'media' );
        }
        wp_enqueue_media();
    }
    add_action( 'admin_enqueue_scripts', 'my_admin_load_styles_and_scripts' );
}
 
function remix_enqueue_styles() {

    if(is_admin()) {

    wp_enqueue_style('remix_plugin');
      wp_enqueue_style('remix_plugin_articles');
    wp_enqueue_style('admin_boot');
    wp_enqueue_style('fontawesome');
    wp_enqueue_style('selectcss');


    wp_register_script( 'selectjs',"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js" );
    wp_enqueue_script('selectjs');
    wp_register_script( 'remixjs',"/wp-content/plugins/remix/js/remix.js" );
    wp_enqueue_script('remixjs');

   }

}

add_action('admin_init', 'remix_register_styles');
add_action( 'admin_enqueue_scripts', 'remix_enqueue_styles' );


if(is_admin()) {

require_once(REMIX_PLUGIN_PATH . '/class/class.tablebuilder.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.menu.php');

$build = new tableBuilder;

$db = $build->init_hooks();

$build_menu = new Menu;

$g = $build_menu->menu_init();

}

require_once(REMIX_PLUGIN_PATH . '/class/class.articles.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.collection.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.instagram.php');
require_once(REMIX_PLUGIN_PATH . '/remix-functions.php');

?>

















