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
define( 'REMIX_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

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
}

add_action( 'admin_init', 'remix_plugin_styles' );

require_once('/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/class/class.articles.php');
require_once('/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/class/class.collection.php');
require_once('/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/class/class.tablebuilder.php');
require_once('/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/class/class.menu.php');
require_once('/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/remix-functions.php');
require_once('/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/class/class.instagram.php');

$build = new tableBuilder;

$db = $build->init_hooks();

$build_menu = new Menu;

$g = $build_menu->menu_init();


?>

















