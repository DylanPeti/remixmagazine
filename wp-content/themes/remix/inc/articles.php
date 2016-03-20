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

<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">
     
      <?php foreach ($articles as $item) : ?>
        
         <?php 


             $count++;

             if($count == 4) {
                if(!empty(get_adverts('widget-article-advert-one') ) ){
                    echo get_adverts('widget-article-advert-one');
                    continue;
                } 
             }

             if($count == 8) {
               if(!empty(get_adverts('widget-article-advert-two') ) ){
                   echo get_adverts('widget-article-advert-two');
                   continue;
                 }
             }

             article($item); 

          ?>
         
      <?php endforeach; ?>

      
    </div>

  </div>

</section>








