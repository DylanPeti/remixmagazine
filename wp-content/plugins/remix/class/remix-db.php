<?php 
$table_name = $wpdb->prefix . 'remix_articles';
 
// function to create the DB / Options / Defaults					
function your_plugin_options_install() {
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
// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'your_plugin_options_install');