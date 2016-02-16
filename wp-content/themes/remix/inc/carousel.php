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
?>
<section id="carousel-section">
  <div class="container">
    <article class="article-carousel">
      <div id="myCarousel" class="carousel slide article-carousel-box" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <?php $split = array_chunk($single_cats, 5); ?>
          <?php $dog = array(); ?>
          <?php foreach ($split as $items) : ?>
          <?php $dog[] = $items; ?>
          
          <div class="item article-carousel-item  <?php echo (count($dog) == 1 ? "active" : '');  ?>">
            <?php foreach ($items as $item) : ?>
            
            <div class="col-md-2">
              <div class="carousel-image" style="background: url(<?php echo remix_thumbnail_url('', 'post', $item->ID); ?>);"></div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        
      </div>
    </article>
  </div>
</section>