  <?php 

  if()

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


    $count = 0;

    $recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 

    $articles = get_articles(0, array($recent_post[0]->ID)); 

    $posts = (count(get_adverts("top")) ? articles_with_adverts("top", $articles) : $articles);

    foreach ($posts as $item) : 

            $count++;

            if(isset($item->location)) {
             echo advert($item, $count);
            
            } else {
         
            article($item); 
          }
        

          ?> 
         
      <?php endforeach; ?>

      
    </div>

  </div>

</section>








