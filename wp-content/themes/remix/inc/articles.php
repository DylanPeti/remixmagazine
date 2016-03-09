<?php 

var_dump($position);

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

<script>
  
</script>








<?php $categories = the_latest_from_categories(); ?>

<?php $ids = array(); ?>

<?php foreach($categories as $items) : ?>

	     <?php $args = array( 'numberposts' => 1, 'category' => $items->cat_ID, 'post_type' => 'post'); ?>

	     <?php $posts = get_posts($args); ?>

	     <?php foreach ($posts as $post) : ?>

               <?php $ids[] = $post->ID; ?>

	     <?php endforeach; ?>


<?php endforeach; ?>

<?php $articles = get_articles(1, $ids); ?>


<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">
     
      <?php foreach ($articles as $item) : ?>
     
         <?php article($item); ?>
       
      <?php endforeach; ?>
      
    </div>

  </div>

</section>

<script>
  
</script>
