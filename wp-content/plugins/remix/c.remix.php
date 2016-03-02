<?php

class Remix {

   private $table;

   function __construct() {

   	  global $wpdb;
   	 
   	  $prefix = $wpdb->prefix . "remix_";
      $this->articleTable = $prefix . "article_collection";
      $this->heroTable = $prefix . "hero";
      $this->carouselTable = $prefix . "carousel";
      $this->socialTable = $prefix . "social";
      
    }

    private function init() {

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

    private function menu() {

    }
    
    private function load_views() {

    }

    public function activate_plugin() {

      register_activation_hook( __FILE__, 'remix_install' );

    }



}


















