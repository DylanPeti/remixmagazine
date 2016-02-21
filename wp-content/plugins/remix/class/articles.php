<?php 

class Articles {

	function __construct() {
		$this->table = $wpdb->prefix . "remix_articles";
	}
	

	function create_articles($articles) {
        global $wpdb;
        
        $table_name = $this->table;

        $articles = get_articles(); 

        $args = array(
          'article_author' => $article_author,
          'article_date' => cuurent_time( 'mysql' ), 
          'articles_collection' => $article_collection, 
          'article_status' => $article_status,
        	);

        $wpdb->insert($table_name, array($args));
	}

	function read_articles() {

	}

	function update_articles() {

	}

	function delete_articles() {
        
	}

	function get_articles() {
		
	}

}


