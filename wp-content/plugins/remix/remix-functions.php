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


function get_articles($index = 0, $ids = array()) {

   global $class; 

   $article = $class::read("article")[$index];
 
   if($article->page == "Home") :

   	    $type = $article->type;

   	    return $type($article->count, $ids, $index);

   endif;

}




function get_instagram($id = 'self', $limit = 0) {

  $class = "Remix";
  if(count($class::read("social")[0])) {

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

    $thumb[] = array(
      'thumb' => $link->images->standard_resolution->url,
      'link' => $link->link
    );
  
  } 

  $img = array_chunk($thumb, 5); 

  return $img;

  }

}

}


function the_latest_posts($count, $ids = array(), $index) {

    $do_not_duplicate = array();
    if($index == 1) {
      $count = $count + 1;
    }
	  $args = array('numberposts' => $count);

	  $posts = wp_get_recent_posts( $args, OBJECT );
      
      $do_not_duplicate[] = (isset($duplicates[0]) ? $duplicates[0] : false);
      $do_not_duplicate[] = (isset($duplicates[1]) ? $duplicates[1] : false);
      $do_not_duplicate[] = (isset($duplicates[2]) ? $duplicates[2] : false);
      $do_not_duplicate[] = 9767;

      foreach($ids as $id) {
        $do_not_duplicate[] = $id;
      }

      $new_args = array('numberposts' => $count, 'post__not_in' => $do_not_duplicate, 'post_status' => 'publish',);

      $items = wp_get_recent_posts( $new_args, OBJECT );

      if($index == 1) {
      array_shift($items);

      }

      $result = $items;
  
	  return $result;
}


function the_latest_from_categories($count = null, $ids = array()) {


$recent_posts = array(
    'numberposts' => 1,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 

 );


$recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 

$late = $recent_post[0]->ID;

	$categories = array("fashion", "beauty", "culture", "lifestyle", "events",
		                 "men's", "research", "win");
    $cat_ids = array();

    foreach($categories as $cat) :

      $cat_ids[] = get_cat_ID($cat);

    endforeach;

    $ids[] = $late;
    $ids[] = 9767;
    
    $compact_cats = array(implode(',',$cat_ids));

    $args = array('include' => $compact_cats[0], 'taxonomy' => 'category');
   
    $posts = get_categories( $args );

    $items = array();

    foreach($posts as $post) {

    $args = array('numberposts' => 1, 'post__not_in' => $ids, 'category' => $post->cat_ID, 'post_status' => 'publish');
      $latest_post = get_posts( $args );
      $items[] = $latest_post[0];
    }

   
    return $items;

}


function article($item) {

$description = wp_trim_words($item->post_content, 100);
$title = $item->post_title;
$link = thumbnail_link($item);
$category = get_the_category($item->ID);
$image = remix_thumbnail_url($item); 
$category = $category[0]->name;
?>
<article class="article">

   <a href="<?php echo $link; ?>"> 
    <div class="article-img" style="background-image: url(<?php echo $image; ?>)">
    </div>
   </a>
    
    <div class="article_exerpt">
      <span class="article-tag <?php echo strtolower($category); ?>"><?php echo $category; ?></span>
       <a href="<?php echo $link; ?>"> 
      <h2><?php echo substr($title, 0, 52); ?></h2>
      </a>
      <ul class="entypo-icons">
        <div class="social-btn" id="fbshare" data-share="<?php echo $link ?>,<?php echo $title ?>,<?php echo $image ?>, <?php echo $description ?>">
          <li class="entypo-facebook"></li>
        </div>
        <div class="social-btn">
          <li class="entypo-twitter">
            
          </li>
        </div>
      </ul>
      
    </div>
<!--   </a> -->
  
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
   
      if(isset($object->taxonomy)) {
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








