<?php 
class Articles {

static $table;

  function __construct($table) {
   
    global $wpdb;

    $this->table($table);


  }

  static function table($table) {
     self::$table = $table;
   
     return self::$table;
  }
    
	static function create_articles($article) {
		
        global $wpdb;

        $table = self::article_table();

        $args = array(
          'time' => current_time('mysql'),
          'author' => $article['author'], 
          'page' => $article['page'],
          'type' => $article['type'],
          'count' => $article['count'],
          'status' => $article['status']
        	);

        $wpdb->insert($table, $args);
	}


	static function read_articles($id = null, $column = null, $value = null ) {
    
     $table = self::$table = "remix";
     print_r($table);

		global $wpdb;
        
        if($id) :

        $query = $wpdb->get_results('SELECT * FROM ' . $table . ' WHERE id =' . $id);

        $results = $query[0];

        elseif($column) :

        $query = $wpdb->get_results('SELECT * FROM ' . $table . ' WHERE ' . $column . " = " . "'" . $value . "'"); 

        $results = $query;

        else :

		    $results = $wpdb->get_results("SELECT * FROM $table  WHERE type <> 'hero'");

	     endif;

		return $results;

	}

	static function update_articles($form, $ID) {
      
      global $wpdb;
      
      $table = self::article_table();

      $data = array(
          'time' => current_time('mysql'),
          'type' => $form['type'],
          'count' => $form['count'],
      );

      $where = array( 'ID' => $ID );

      $wpdb->update( $table, $data, $where , $format = null, $where_format = null ); 

	}

	static function delete_articles($ID) {

        global $wpdb;

        $table = self::article_table();

        $wpdb->delete( $table, array( 'post_id' => $ID ) );

	}



}



