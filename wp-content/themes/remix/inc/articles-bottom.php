<?php $articles = get_articles(1); ?>


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


