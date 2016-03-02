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
// 
// 


function sections(){ 

	$sections = array(
   	"General",
   	"Hero",
   	"Articles",
   	"Carousel" 
   	);

   	return $sections;
}

 /**
     * Add Remix Menu
     *  
     * Remix - All Sections
     * Hero
     * Articles
     * Carousel
     * 
     */
    
function load_views($plugin) {
     print_r($plugin);
    }


add_action('admin_menu', 'add_article_menu');


function add_article_menu() {
 
  foreach(sections() as $submenu) :

  	$plugin = "remix";
    print_r($plugin);

  	$slug = "remix-collection-" . strtolower($submenu) . ".php";
  	$callback = "template_" . strtolower(str_replace("-", "_", $submenu));
    
    add_menu_page( 'My Plugin Menu', 'Remix', 'manage_options', 'remix', 'remix_index' );
    add_submenu_page ($plugin, $plugin, $submenu, 'manage_options', $slug, 'load_views');


  endforeach;


function remix_index() {
       if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/index.php");
}


   // add_submenu_page( 'remix', 'remix', 'All Collections', 'manage_options', 'remix-articles.php', 'articles_options');
   // add_submenu_page( 'remix', 'remix', 'Add New', 'manage_options', 'article-collection-new.php', 'article_collection_new_options');
   // add_submenu_page( 'remix', 'remix', 'Edit', 'manage_options', 'article-collection-edit.php', 'article_collection_edit_options');

   // add_submenu_page( 'remix', 'remix', 'Hero Edit', 'manage_options', 'article-collection-hero-edit.php', 'article_collection_hero_edit');

   //  add_submenu_page( 'remix', 'remix', 'Instagram', 'manage_options', 'instagram.php', 'article_collection_instagram');

}





function article_collection_instagram() {

		if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/instagram.php");

}

function article_collection_hero_edit() {

		if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/article-collection-hero-edit.php");
}


function articles_options() {

		if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/articles.php");
}

function article_collection_new_options() {
       if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/article-collection-new.php");
}

function article_collection_edit_options() {
       if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

       require (dirname( __FILE__ ) . "/templates/article-collection-edit.php");
}



$table_name = $wpdb->prefix . 'remix_articles';
 
// function to create the DB / Options / Defaults					
function remix_install() {
   	global $wpdb;
  	global $table_name;
 
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
	{
		$sql = "CREATE TABLE " . $table_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	    article_author tinytext NOT NULL,
		UNIQUE KEY id (id)
		);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
 
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

///wp-admin/admin.php?page=remix-articles&article=4




function articles_id( $query_vars ){
    $query_vars[] = 'id';
    return $query_vars;
}

add_filter( 'query_vars', 'articles_id' );









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

require_once('class.articles.php');
require_once('class.collection.php');

require_once('class.instagram.php');

require_once('class.actions.php');


?>

















