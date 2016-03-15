<div class="remix-wrapper">
   <div class="container">
    <div class="title">
   	  <h1>Adverts</h1>
    </div>
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


$recent_post = wp_get_recent_posts( $recent_posts, OBJECT); 

$articles = get_articles(0, array($recent_post[0]->ID)); ?>

<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">
     
      <?php foreach ($articles as $item) : ?>
     
         <?php article($item); ?>
       
      <?php endforeach; ?>
      
    </div>

  </div>

</section>

      


  </div>

</section>



    </div>
    </div>