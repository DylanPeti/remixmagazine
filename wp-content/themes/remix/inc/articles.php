<?php $articles = get_articles(); ?>


<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">
     
      <?php foreach ($articles as $item) : ?>
     
        <?php $cat_class = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $item->cat_name)); ?>
        
        <article class="article">
       
<div class="article-img" style="background-image: url(<?php echo remix_thumbnail_url($item->name, "cat") ?>)">
          </div>
        
          <div class="article_exerpt">
            <span class="article-tag <?php echo strtolower($item->cat_name); ?>"><?php echo $item->title ?></span>
            
            <h2><?php echo substr($item->cat_name, 0, 52); ?></h2>
            
            <ul class="entypo-icons">
              <li class="entypo-facebook"></li>
              <li class="entypo-twitter"></li>
            </ul>
          
          </div>
       
        </article>
       
      <?php endforeach; ?>
      
    </div>

  </div>

</section>