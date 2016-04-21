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
   
    <div class="article-collection article-collection-bottom">
     <?php $count = 0; 
      $articles_with_adverts = articles_with_adverts("bottom", $articles);
       foreach ($articles_with_adverts as $item) : 
   
      	 $count++; 
     
            if(isset($item->location)) {
             echo get_adverts($item, $count);
            
            } else {
         
            article($item); 
          }

          
       
        endforeach; ?>
      
    </div>

    <?php $offset = 7; ?>

    <div id="more-posts" data-offset=<?php echo $offset ?>>
    <h5>Loading more articles</h5>
    <i class="fa fa-spinner" aria-hidden="true"></i>
    </div>

  </div>

</section>

<script>
  
</script>


<!-- <button id="more" class="btn btn-primary" style="margin: 0 auto; display: block; float: none;">More Articles</button> -->

