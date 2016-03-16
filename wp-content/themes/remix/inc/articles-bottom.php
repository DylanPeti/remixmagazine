<?php $categories = the_latest_from_categories(); ?>

<?php $ids = array(); ?>
<?php


$new_args = array('numberposts' => 8, 'post_status' => 'publish');

$items = wp_get_recent_posts( $new_args, OBJECT );
foreach ($items as $recent) {
   $ids[] = $recent->ID;
}


?>

<?php foreach($categories as $items) : ?>

               <?php $ids[] = $items->ID; ?>

<?php endforeach; ?>



<?php $articles = get_articles(1, $ids); ?>


<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">
     <?php $count = 0; ?>
      <?php foreach ($articles as $item) : ?>

      	<?php $count++; ?>
     
         <?php

          if($count == 4) {
                if(!empty(get_adverts('widget-article-advert-three') ) ){
                    echo get_adverts('widget-article-advert-three');
                    continue;
                } 
             }

          article($item); 

          ?>
       
      <?php endforeach; ?>
      
    </div>

  </div>

</section>

<script>
  
</script>


<!-- <button id="more" class="btn btn-primary" style="margin: 0 auto; display: block; float: none;">More Articles</button> -->

