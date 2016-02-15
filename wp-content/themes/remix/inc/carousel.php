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
      <div class="item active">
        <div class="col-md-4">
          <img src="<?php echo remix_thumbnail_url('', 'post', $item->ID) ?>">
        </div>
      </div>
      <?php foreach ($single_cats as $item) : ?>
      <div class="item article-carousel-item">
        <div class="col-md-4">
<div class="carousel-image" style="background: url(<?php echo remix_thumbnail_url('', 'post', $item->ID); ?>);"></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
    
  </div>
</article>

</div>


</section>