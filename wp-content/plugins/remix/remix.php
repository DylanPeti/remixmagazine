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


add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	 add_menu_page( 'My Plugin Menu', 'Remix', 'manage_options', 'remix', 'my_plugin_options' );

}

function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}


add_action('admin_menu', 'add_article_menu');

function add_article_menu() {
   add_submenu_page( 'remix', 'eemix', 'Articles', 'manage_options', 'remix-articles', 'articles_options'); 
}

function articles_options() {

		if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/articles.php");
}



function remix_install() {
	global $wpdb;
	global $remix_db_version;

	$table_name = $wpdb->prefix . 'remix_article_collection';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
	    ID mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		collection_author bigint(20) NOT NULL,
		collection_category bigint(10) NOT NULL, 
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'remix_db_version', $remix_db_version );
}

function remix_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
	$table_name = $wpdb->prefix . 'remix_article_collection';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'collection_author' => 2, 
		) 
	);
}

register_activation_hook( __FILE__, 'remix_install' );
register_activation_hook( __FILE__, 'remix_install_data' );

/**
 * Proper way to enqueue scripts and styles.
 */

function remix_plugin_styles() {
    wp_register_style( 'remix_plugin',"/wp-content/plugins/remix/css/style.css" );
    wp_enqueue_style('remix_plugin');
}
add_action( 'admin_init', 'remix_plugin_styles' );


?>

















