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

/**
 * Proper way to enqueue scripts and styles.
 */

function remix_plugin_styles() {
    wp_register_style( 'remix_plugin',"/wp-content/plugins/remix/css/style.css" );
    wp_enqueue_style('remix_plugin');
    wp_register_style('admin_boot', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); 
    wp_enqueue_style('admin_boot');

    wp_register_style('fonta', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'); 
    wp_enqueue_style('fonta');


     wp_register_style( 'selectcss',"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/css/select2.min.css" );

     wp_enqueue_style('selectcss');

     wp_register_script( 'selectjs',"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2-rc.1/js/select2.min.js" );

      wp_enqueue_script('selectjs');

        wp_register_script( 'remixjs',"/wp-content/plugins/remix/js/remix.js" );

          wp_enqueue_script('remixjs');





}

add_action( 'admin_init', 'remix_plugin_styles' );
require_once(REMIX_PLUGIN_PATH . '/class/class.articles.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.collection.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.tablebuilder.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.menu.php');
require_once(REMIX_PLUGIN_PATH . '/class/class.instagram.php');

require_once(REMIX_PLUGIN_PATH . '/remix-functions.php');

$build = new tableBuilder;

$db = $build->init_hooks();

$build_menu = new Menu;

$g = $build_menu->menu_init();


?>

















