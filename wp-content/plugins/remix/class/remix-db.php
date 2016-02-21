<?php

global $remix_db_version;
$remix_db_version = '1.0';

function remix_install() {
	global $wpdb;
	global $remix_db_version;

	$table_name = $wpdb->prefix . 'remix_articles';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		article_collection_id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	    article_author tinytext NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	print_r($sql);

	add_option( 'remix_db_version', $remix_db_version );
}



          // 'article_author' => $article_author,
          // 'article_date' => cuurent_time( 'mysql' ), 
          // 'articles_collection' => $article_collection, 
          // 'article_status' => $article_status,