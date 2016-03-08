<?php

/**
 *
 *
 *
 *
 *
 * 
 */

class tableBuilder {

 private static $_tables;

    function __construct() {
    
       	global $wpdb;
       	 
       	$prefix = $wpdb->prefix . "remix_";

       	$table = array("hero", "article", "carousel", "social", "socialmeta");
       
        $tables = $this->table($table, $prefix);
 
          
    }

    public function init_hooks() {

    	register_activation_hook(PATH, array('tableBuilder', 'table_init'));
      register_activation_hook(PATH, array('tableBuilder', 'fill_tables'));

    }

    public function table($table, $prefix = null) {

         foreach ($table as &$value)
         	$value = $prefix . $value; 

     	 self::$_tables = $table;

    }

    public static function table_sql() {
    	
    $tables = self::$_tables;

    $sql = array();

        foreach ($tables as $table) :

        	switch ($table) :
        		case 'wp_remix_hero':
                 $sql[$table] = "CREATE TABLE " . $table . " (
		                  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
		                  `post_id` bigint(20) DEFAULT NULL,
		                  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		                  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
		                  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		                  `count` int(11) DEFAULT NULL,
		                   UNIQUE KEY `id` (ID)
		                    );";
        			break;

        		case 'wp_remix_article':
        		$sql[$table] = "CREATE TABLE " . $table . " (
		                  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
		                  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		                  `author` bigint(20) unsigned NOT NULL DEFAULT '0',
		                  `page` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
		                  `type` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		                  `count` int(11) DEFAULT NULL,
		                  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		                   UNIQUE KEY `id` (ID)
		                    );";

        	        break;
        	    case 'wp_remix_carousel':

        	    $sql[$table] = "CREATE TABLE " . $table . " (
		                  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
		                  `provider_id` bigint(20) unsigned NOT NULL DEFAULT '0',
                          `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `count` int(11) DEFAULT NULL,
		                   UNIQUE KEY `id` (ID)
		                    );";

        		    break;
        		
        		case 'wp_remix_social':

        		$sql[$table] = "CREATE TABLE " . $table . " (
		                  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
		                  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `app_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `app_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `app_callback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		                   UNIQUE KEY `id` (ID)
		                    );";

        		    break;

        		case 'wp_remix_socialmeta':

        		$sql[$table] = "CREATE TABLE " . $table . " (
		                  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		                  `provider_id` bigint(20) unsigned NOT NULL DEFAULT '0',
		                  `meta_property` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `meta_value` longtext COLLATE utf8mb4_unicode_ci,
		                   PRIMARY KEY (`meta_id`)
		                    );";
  
        		    break;

        		default:

        		$sql = null;

        		break;

         	  endswitch;

        	endforeach;

        return $sql;
        
    }

    public static function table_init() {

        global $wpdb;
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $sql = self::table_sql();

        $tables = self::$_tables;

        foreach($sql as $key => $database_table) :

         if($wpdb->get_var("SHOW TABLES LIKE '$key'") != $key) {

            dbDelta($database_table);

        }

        endforeach;

    }
    
    public static function fill_tables() {

      $pages = array("Home", "Category", "Blog");

       global $wpdb;

        $table = $wpdb->prefix . "remix_article";
      

       foreach($pages as $page) :
        $args = array(
          'time' => current_time('mysql'),
          'author' => 0, 
          'page' => $page,
          'type' => "the_latest_posts",
          'count' => 8,
          'status' => 'active'
          );

        $wpdb->insert($table, $args);

        endforeach;

      

     }
}