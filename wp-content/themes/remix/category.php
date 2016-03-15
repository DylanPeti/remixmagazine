 <?php

get_header(); 

$categories = get_the_category();
$category_id = $categories[0]->cat_ID;

$args = array(
    'numberposts' => 40,
    'offset' => 0,
    'category' => $category_id,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true 

 );
?>


<?php $posts = get_posts($args); ?>

<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">
     
    <?php foreach($posts as $post) : ?>
     
         <?php article($post); ?>
       
      <?php endforeach; ?>
      
    </div>

  </div>

</section>



<?php get_footer(); ?>