
<div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#heroCarousel" data-slide-to="1"></li>
    <li data-target="#heroCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    
    <?php
    $count = 0;
    $hero = get_hero();
    foreach ($hero as $dog) {
    $count++;
 ?>


   <?php if($count == 1) { $active = "active";  } else { $active = ''; } ?>

    <div class="item <?php echo $active; ?>">
      <div class="hero" style="background-image: url(<?php echo remix_thumbnail_url($dog) ?>)">
        <div class="container">
          <div class="article_exerpt">
         <!--    <span class="article-tag">Category</span> -->
              <a href="<?php echo get_the_permalink($dog->ID); ?>">
                 <h2><?php echo $dog->post_title; ?></h2>
              </a>
           <?php if(strlen($dog->post_title) < 59) { ?>
      <p class="hero-desc"><?php echo $dog->post_excerpt; ?></p>  
      <?php } ?>

<!--             <span class="author"><?php echo $dog->post_author; ?></span> -->
            <ul class="entypo-icons">
              <li class="entypo-facebook"></li>
              <li class="entypo-twitter"></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    

    <?php } ?>

  </div>

  
  <a class="left carousel-control" href="#heroCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#heroCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>