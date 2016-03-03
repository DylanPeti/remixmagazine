<?php
/**
 *
 *
 * 
 */

class Menu  {

     public static $_mainmenu;
     public static $_submenu;


     
      function __construct() {

        $main = "remix";
        $submenu = array("Hero", "Articles", "Carousel");

        $mainmenu = $this->menuitems($main, $submenu);


     }

     public static function menu_init() {
          
          return add_action('admin_menu', array('Menu', 'the_menu'));

     }

     public function menuitems($main, $submenu) {

     	 self::$_mainmenu = $main;
     	 self::$_submenu = $submenu;

     }

     public static function the_menu() {

       $main = self::$_mainmenu;	
       $submenu = self::$_submenu;

       $main_slug = $main . ".php"; 
 
       add_menu_page('My Plugin Menu', $main, 'manage_options', $main_slug, array('Menu', 'views'));

       foreach($submenu as $menu_item) :
     
  	     $slug = "remix-collection-" . strtolower($menu_item) . ".php";
  	     $callback = "template_" . strtolower(str_replace("-", "_", $menu_item));
         
         add_submenu_page ($main_slug, $main, $menu_item, 'manage_options', $slug, array('Menu', 'views'));

       endforeach;

     }

     public static function views() {

     	$page = $_GET['page'];

        if ( !current_user_can( 'manage_options' ) )  {

		    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	    
	     }

       require ("/Users/dylanpeti/Sites/remixmagazine/wp-content/plugins/remix/templates/" . $page);

     }



}



