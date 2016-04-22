<?php 
class Remix {

static $table;

  function __construct($table) {
   
    global $wpdb;

    $this->table($table);


  }

  static function table($table) {
     self::$table = $table;
   
     return self::$table;
  }
    
	static function create($table, $form) {
		
        global $wpdb;
        $table = $wpdb->prefix . "remix_" . $table;

         $args = array();

         foreach ($form['data'] as $key => $value) {
      
         $key = str_replace("'", "", $key);
         $args[$key] = $value;

         }

         // $args['time'] = current_time('mysql');


         $wpdb->insert($table, $args);
	}

	static function read($table, $id = null, $column = null, $value = null ) {

		global $wpdb;
    $table = $wpdb->prefix . "remix_" . $table;

		    $results = $wpdb->get_results("SELECT * FROM $table");

		return $results;

	}

	static function update($table, $form) {
      
      global $wpdb;

      $table = $wpdb->prefix . "remix_" . $table;

      $data = array();

       foreach ($form['data'] as $key => $value) {
         $key = str_replace("'", "", $key);

         if(!empty($value)) {
         $data[$key] = $value;
         }
       }

      $rows = $wpdb->get_results("SELECT * FROM $table");

      if(isset($rows[0]->time)) {
 
         $data['time'] = current_time('mysql');

      }

      $where = array( 'ID' => $form['id'] );

      $wpdb->update( $table, $data, $where , $format = null, $where_format = null ); 

	}

	static function delete($table, $ID) {

        global $wpdb;
  
        $table = $wpdb->prefix . "remix_" . $table;
 
        $wpdb->delete( $table, array( 'post_id' => $ID ) );

	}

  static function delete_advert($table, $ID) {

        global $wpdb;
  
        $table = $wpdb->prefix . "remix_" . $table;
 
        $wpdb->delete( $table, array( 'id' => $ID ) );

  }
 
 static function replace($table, $data, $ID) {

       global $wpdb;

        $table = $wpdb->prefix . "remix_" . $table;

        $data['data']['id'] = $ID;

        $data = $data['data'];

        $wpdb->replace( $table, $data ); 
 }


}














