  <?php 

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

$count = 0;

$recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 

$articles = get_articles(0, array($recent_post[0]->ID)); ?>

<section id="article-section" class="black" >
  
  <div class="container">
   
    <div class="article-collection">

    <?php 

function insert_advert($item) {
 
}

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

function articles_with_adverts($articles) {

$array = get_advert("top");

 foreach($array as $advert) {

          $position = $advert->position;
    
          array_splice($articles, $position, 0, array($advert));

    }

     $sliced = array_slice($articles, 0, 8);

     return $sliced;

}

    $count = 0;

    $recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 

    $articles = get_articles(0, array($recent_post[0]->ID)); 

    $articles_with_adverts = articles_with_adverts($articles);

    foreach ($articles_with_adverts as $item) : 

            $count++;

            if(isset($item->location)) {
             echo get_adverts($item, $count);
            
            } else {
         
            article($item); 
          }
            

          ?> 
         
      <?php endforeach; ?>

      
    </div>

  </div>

</section>








