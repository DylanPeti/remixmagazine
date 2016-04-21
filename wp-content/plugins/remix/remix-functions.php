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


function the_latest_posts($count = 0, $ids = array(), $index = 0) {

    $do_not_duplicate = array();
    $do_not_duplicate[] = 9767;
    $offset = ($index == 0 ? 1 : 7);

	  $args = array('numberposts' => $count, 'post__not_in' => $do_not_duplicate, 'post_status' => 'publish', 'offset' => $offset);
      
     $items = wp_get_recent_posts( $args, OBJECT );

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


function article($item, $advert = null, $count = null) {



$description = wp_trim_words($item->post_content, 100);
$title = (isset($item->post_title) ? $item->post_title : '');
$link = thumbnail_link($item);
$category = get_the_category($item->ID);
$image = remix_thumbnail_url($item); 
$category = $category[0]->name;
$cat_id = get_cat_ID($category);
$category_link = get_category_link($cat_id);
$count = (isset($count) ? $count : "");


?>
<article class="article" data-position="<?php echo $count ?>">

<?php if(is_admin()) { ?>
<div class="advert-overlay green-overlay">
 <div class="advert-taken">
  <h4>Slot Selected</h4>
  <p>About</p>
   <h5>Advert Slot Unavailable</h5>
   <p>Note: If you choose this slot, the current advert slot will be replaced by the new advert.</p>
  </div>
</div>
<?php } ?>
   <a href="<?php echo $link; ?>"> 
    <div class="article-img" style="background-image: url(<?php echo $image; ?>)">
    </div>
   </a>
    
    <div class="article_exerpt">
      <a href="<?php echo esc_url( $category_link ); ?>"><span class="article-tag <?php echo strtolower($category); ?>"><?php echo $category; ?></span></a>
       <a href="<?php echo $link; ?>"> 
      <h2><?php echo substr($title, 0, 52); ?></h2>
      </a>
      <ul class="entypo-icons">
        <div class="social-btn" id="fbshare" data-share="<?php echo $link ?>,<?php echo $title ?>,<?php echo $image ?>, <?php echo $description ?>">
          <li class="entypo-facebook"></li>
        </div>
        <div class="social-btn">
        <a class="twitter-mention-button" target="_blank"
             href="https://twitter.com/intent/tweet?url=<?php echo $link ?>&text=<?php echo $title ?> - &via=REMIXmagazine">
          <li class="entypo-twitter">
            
          </li>
          </a>
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

function get_advert($position) {

   global $class;

   $adverts = $class::read("adverts");

   $items = array();

   foreach ($adverts as $advert) {
    if($advert->location == $position) {
      $items[] = $advert;
    }
   }

   return $items;

}

function get_adverts($advert, $count) { 

$image = $advert->image;

$link = $advert->link;

$count = (isset($count) ? $count : "");

if(is_admin()) {
return <<<HTML
<article class="article advert" data-position="$count"> 
<div class="advert-overlay blue-overlay">
  <div class="advert-taken">
  <h4>Current Advert</h4>
  <p>$advert->title</p>
   <h5>Advert Slot Unavailable</h5>
   <p>Note: If you choose this slot, the current advert slot will be replaced by the new advert.</p>
  </div>
</div>
<div class="advert-overlay green-overlay">
  <div class="advert-taken">
  <h4>SELECTED</h4>
  <p>$advert->title</p>   
   <p>Note: This article will now be replaced by the new advert.</p>
  </div>
</div>
  <div class="ad">
  <a href="$link" target="_blank">
            <div class="ad-img" style="background-image: url($image)"></div>
  </a>
            <div class="ad-content">
            <span class="ad-tag">PROMOTION</span>

            <a href="$link" target="_blank"><button class="ad-btn">Learn More</button></a>
           </div>
        </div>
  
</article>
HTML;
} else {
  return <<<HTML
<article class="article advert" data-position="$count"> 
  <div class="ad">
  <a href="$link" target="_blank">
            <div class="ad-img" style="background-image: url($image)"></div>
  </a>
            <div class="ad-content">
            <span class="ad-tag">PROMOTION</span>

            <a href="$link" target="_blank"><button class="ad-btn">Learn More</button></a>
           </div>
        </div>
  
</article>
HTML;
}
}

function articles_with_adverts ($location, $articles) {

$array = get_advert($location);

 foreach($array as $advert) {

          $position = $advert->position - 1;
    
          array_splice($articles, $position, 0, array($advert));

    }

     $sliced = array_slice($articles, 0, 8);

     return $sliced;

}






