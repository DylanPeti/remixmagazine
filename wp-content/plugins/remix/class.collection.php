<?php

class Collection {


    static function get_latest_articles($post_type, $post_count, $duplicates = null) {


      $do_not_duplicate = array();

	    $args = array('numberposts' => 10);

	    $posts = wp_get_recent_posts( $args, OBJECT );
      
      $do_not_duplicate[] = (isset($duplicates[0]) ? $duplicates[0] : false);
      $do_not_duplicate[] = (isset($duplicates[1]) ? $duplicates[1] : false);
      $do_not_duplicate[] = (isset($duplicates[2]) ? $duplicates[2] : false);

      $new_args = array('numberposts' => $post_count, 'post__not_in' => $do_not_duplicate);

      $items = wp_get_recent_posts( $new_args, OBJECT );
  
	    return $items;

    }

 static function filter_posts($collection) {
      
    
    $articles = Articles::read_articles(null, 'page', $collection)[0]; 

    if ($articles->collection_type == "the_latest_posts") :

        $collection = self::get_latest_articles('post', $articles->collection_count);
    
    else: 

       $collection = self::get_latest_from_categories('post', $articles->collection_count);

    endif;  
       
        $post_type = $articles->collection_type;

        $posts = array();


    
        foreach($collection as $item) :
            $cat = get_the_category($item->ID)[0]->name;

 $category = (isset($item->ID) ? get_the_category($item->ID)[0]->name : " "); 
 $title = (isset($item->post_title) ? $item->post_title : (isset($item->name) ? $item->name : " " ) ); 
 $image = ($post_type == "the_latest_from_categories" ? remix_thumbnail_url($item->name, 'cat') : remix_thumbnail_url('', 'post', $item->ID)); 
 $link = ($post_type == "the_latest_from_categories" ? get_category_link( get_cat_ID($item->name ) ) : get_permalink($item->ID));
    
               $posts[] = [  
                           'category' => $category,
                           'title' => $title,
                           'image' => $image, 
                           'link' => $link,
                           ];
        endforeach;
               

  return $posts;    
}



    static function get_latest_from_categories($post_count = null) {

        $car_items = array(
        get_cat_ID("fashion"), 
        get_cat_ID("beauty"), 
        get_cat_ID("Culture"),
        get_cat_ID("Lifestyle"),
        get_cat_ID("#soulsundaysessions"),
        get_cat_ID("#notatourist"),
        get_cat_ID("outandabout"),
        get_cat_ID("Research")
      
        );
      
      
      $testing = array(implode(',',$car_items));
      
      
      $args = array(
        'type'                     => 'post',
        'child_of'                 => 0,
        'orderby'                  => 'name',
        'order'                    => 'ASC',
        'include'                  => $testing[0],
        'hide_empty'               => 1,
        'hierarchical'             => 1,
        'taxonomy'                 => 'category',
        'pad_counts'               => false 
      
      ); 

    $posts = get_categories( $args );



    return $posts;

	    

}


  static function get_category_latest($category = null, $post_count) {

    	$cat_ID = get_cat_ID($category); 

    	$args = array('category' => $cat_ID, 'numberposts' => $post_count);

    	$posts = get_posts($args);

    	return $posts;

    }

    static function remix_thumbnail_url($cat_name = null, $post_type, $id = null) {
       if($post_type == "cat") :
       
       $cat_id = get_cat_ID( $cat_name );
         $defaults = array(
       'numberposts' => 1,
       'category' => $cat_id,
       'post_type' => 'post',
       );

       $latest_post = get_posts( $defaults );

       $thumb_id = get_post_thumbnail_id($latest_post[0]->ID);
       
       elseif($post_type == "post") :
       
       $thumb_id = get_post_thumbnail_id($id);
       
       endif;
       
       $post_thumbnail_url = wp_get_attachment_url( $thumb_id );
       
       return $post_thumbnail_url;
       
     }

     function remix_post_author($cat_name) {


      $cat_id = get_cat_ID( $cat_name );
        $defaults = array(
      'numberposts' => 1,
      'category' => $cat_id,
      'post_type' => 'post',
      );

      $latest_post = get_posts( $defaults );
      
      $post_author_id = $latest_post[0]->post_author;
      
      $author_meta = get_the_author_meta('display_name',$post_author_id); 
      
      
      return $author_meta;


}






}
