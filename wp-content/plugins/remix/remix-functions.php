<?php
use MetzWeb\Instagram\Instagram;

$class = "Remix";

function get_hero() {
  
  global $class;

  $heros = $class::read("hero");

  $post = array();

  foreach ($heros as $hero ) :

  	$post[] = get_post($hero->post_id);

  endforeach;

  return $post;

}


function get_articles() {

   global $class; 

   $article = $class::read("article")[0];
 
   if($article->page == "Home") :

   	    $type = $article->type;

   	    return $type($article->count);

   endif;

}


function get_instagram($id = 'self', $limit = 0) {



  $class = "Remix";

  $social = $class::read("social")[0];
  
  $instagram = new Instagram(array(
    'apiKey'      => $social->app_key,
    'apiSecret'   => $social->app_secret,
    'apiCallback' => $social->app_callback
  ));
  
  if(isset($social->access_token)) {

  $instagram->setAccessToken($social->access_token);

  $result = $instagram->getUserMedia('self', 10);

  $url = $result->data;
  
  $thumb = array(); 
  
  foreach($url as $link) {
   
   $thumb[] = $link->images->standard_resolution->url;
  
  } 

  $img = array_chunk($thumb, 5); 
 return $img;

  }

}



function the_latest_posts($count) {

      $do_not_duplicate = array();

	  $args = array('numberposts' => $count);

	  $posts = wp_get_recent_posts( $args, OBJECT );
      
      $do_not_duplicate[] = (isset($duplicates[0]) ? $duplicates[0] : false);
      $do_not_duplicate[] = (isset($duplicates[1]) ? $duplicates[1] : false);
      $do_not_duplicate[] = (isset($duplicates[2]) ? $duplicates[2] : false);

      $new_args = array('numberposts' => $count, 'post__not_in' => $do_not_duplicate);

      $items = wp_get_recent_posts( $new_args, OBJECT );

      $result = $items;
  
	  return $result;
}


function the_latest_from_categories($count) {

	$categories = array("fashion", "beauty", "culture", "lifestyle", "#soulsundaysessions",
		                 "#notatourist", "outandabout", "Research");
    $cat_ids = array();

    foreach($categories as $cat) :

      $cat_ids[] = get_cat_ID($cat);

    endforeach;
    
    $compact_cats = array(implode(',',$cat_ids));

    $args = array('include' => $compact_cats[0], 'taxonomy' => 'category');
   
    $post = get_categories( $args );

    $result = $post;
   
    return $result;

}


function article($item) {


 $category = (isset($item->ID) ? get_the_category($item->ID)[0]->name : " "); 
 $title = (isset($item->post_title) ? $item->post_title : (isset($item->name) ? $item->name : " " ) ); 
 $image = remix_thumbnail_url($item); 
 $link = thumbnail_link($item);
 
$cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $item->cat_name)); ?>
  
        <article class="article">
        <a href="<?php echo $link; ?>">
       
         <div class="article-img" style="background-image: url(<?php echo $image; ?>)">
          </div>
        
          <div class="article_exerpt">
            <span class="article-tag <?php echo strtolower($item->cat_name); ?>"><?php echo $item->title ?></span>
            
            <h2><?php echo substr($title, 0, 52); ?></h2>
            
            <ul class="entypo-icons">
              <li class="entypo-facebook"></li>
              <li class="entypo-twitter"></li>
            </ul>
          
          </div>
          </a>
       
        </article>
<?php }

function thumbnail_link($object) {

  if($object->taxonomy == "category") {

    $link = get_category_link( get_cat_ID($object->name ) );

    } else {

    $link = get_permalink($object->ID);

    }

    return $link;

}



function remix_thumbnail_url($object) {
   
   
       
      if($object->taxonomy == "category") {
        $name = $object->name;
        $cat_id = get_cat_ID( $name );

        $args = array( 'numberposts' => 1, 'category' => $cat_id, 'post_type' => 'post');

        $latest_post = get_posts( $args );

        $thumb_id = get_post_thumbnail_id($latest_post[0]->ID);

      } else {

         $thumb_id = get_post_thumbnail_id($object->ID);

      }
       
       $post_thumbnail_url = wp_get_attachment_url( $thumb_id );

   
       return $post_thumbnail_url;
  
     }








