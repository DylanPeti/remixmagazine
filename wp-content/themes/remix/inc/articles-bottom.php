<?php $categories = the_latest_from_categories(); ?>

<?php $ids = array(); ?>


<?php foreach($categories as $items) : ?>

               <?php $ids[] = $items->ID; ?>

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


