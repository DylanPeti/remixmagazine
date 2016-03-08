<?php


$single_cat = array(
'numberposts' => 20,
'offset' => 0,
'category' => get_cat_ID("Beauty"),
'orderby' => 'post_date',
'order' => 'DESC',
'post_type' => 'post',
'post_status' => 'publish',
'suppress_filters' => true
);


$single_cats = wp_get_recent_posts($single_cat, OBJECT);
$split = array_chunk($single_cats, 5); 
$dog = array(); 





$img = get_instagram(); 


?>
<section id="carousel-section">
  <div class="container">
    <article class="article-carousel">
      <div id="instagramCarousel" class="carousel slide article-carousel-box" data-ride="carousel">
        <div class="carousel-inner" role="listbox">

          <?php foreach ($img as $items) : ?>
          <?php $dog[] = $items; ?>
          
          <div class="item article-carousel-item  <?php echo (count($dog) == 1 ? "active" : '');  ?>">
            <?php foreach ($items as $item) : ?>
            
            <div class="col-md-2">
              <div class="carousel-image" style="background: url(<?php echo $item ?>);"></div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <a class="left carousel-control" href="#instagramCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control" href="#instagramCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        
      </div>
    </article>
  </div>
</section>




