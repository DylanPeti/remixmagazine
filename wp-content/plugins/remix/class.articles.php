<?php 
class Articles {
    

	private function __construct() {
		global $wpdb;
		$this->table = $wpdb->prefix . "remix_articles";
	}
	

	static function create_articles($article) {
		
        global $wpdb;

        $table = $wpdb->prefix . "remix_article_collection";
     

        $args = array(
          'title' => $article['title'],
          'time' => current_time('mysql'),
          'post_id' => $article['post_id'],
          'collection_author' => $article['collection_author'], 
          'collection_category' => 1,
          'collection_type' => $article['collection_type'],
          'collection_count' => $article['collection_count'],
          'collection_status' => $article['collection_status']
        	);

        $wpdb->insert($table, $args);
	}

	static function read_articles($id = null, $column = null, $value = null ) {

		global $wpdb;
        
        if($id) :

        $query = $wpdb->get_results('SELECT * FROM wp_remix_article_collection WHERE id =' . $id);

        $results = $query[0];

        elseif($column) :
         
        $query = $wpdb->get_results('SELECT * FROM wp_remix_article_collection WHERE ' . $column . " = " . "'" . $value . "'"); 

        $results = $query;

        else :

		    $results = $wpdb->get_results("SELECT * FROM wp_remix_article_collection WHERE collection_type <> 'hero'");

	    endif;

		return $results;

	}

	static function update_articles($form, $ID) {
      
      global $wpdb;

      
      $table = $wpdb->prefix . "remix_article_collection";

      $data = array(
          'time' => current_time('mysql'),
          'collection_type' => $form['collection_type'],
          'collection_count' => $form['collection_count'],
      );

      $where = array( 'ID' => $ID );

      $wpdb->update( $table, $data, $where , $format = null, $where_format = null ); 

	}

	static function delete_articles($ID) {

        global $wpdb;

        $table = $wpdb->prefix . "remix_article_collection";

        $wpdb->delete( $table, array( 'post_id' => $ID ) );

	}

}



