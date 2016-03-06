<?php 


class Hero{
    

	private function __construct($table) {
		global $wpdb;
		$this->table = $wpdb->prefix . "remix_articles";

    $this->table = $table;
	}
	

	static function create_articles($article) {
		
        global $wpdb;


        $table = $wpdb->prefix . "remix_article_collection";
     

        $args = array(
          'title' => $article['title'],
          'time' => current_time('mysql'),
          'collection_author' => 3, 
          'collection_category' => 1,
          'collection_type' => $article['collection_type'],
          'collection_count' => $article['collection_count'],
        	);

        $wpdb->insert($table, $args);
	}

	static function read_articles($id = null) {

		global $wpdb;
        
        if($id) :

        $query = $wpdb->get_results('SELECT * FROM wp_remix_article_collection WHERE id =' . $id);

        $results = $query[0];

        else :

		$results = $wpdb->get_results('SELECT * FROM wp_remix_article_collection');

	    endif;

		return $results;

	}

	static function update_articles($form, $ID) {
      
      global $wpdb;

      $table = $wpdb->prefix . "remix_article_collection";

      $data = array(
          'title' => $form['title'],
          'time' => current_time('mysql'),
          'collection_type' => $form['collection_type'],
          'collection_count' => $form['collection_count'],
      );

      $where = array( 'ID' => $ID );

      $wpdb->update( $table, $data, $where , $format = null, $where_format = null ); 

	}

	static function delete_articles($ID) {

        $wpdb->delete( 'table', array( 'ID' => $ID ) );

	}

}



