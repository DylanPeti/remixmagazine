<?php
$img = "/wp-content/themes/remix/images/about-page/";
$thumbnail = array(
$img . '0.jpg',
$img . '1.jpg',
$img . '1a.jpeg',
$img . '1b.jpeg',
$img . '2.jpg',
$img . '2a.jpeg',
$img . '2b.jpeg',
$img . '2c.jpeg',
$img . '3.jpg',
$img . '3a.jpeg',
$img . '3b.jpeg',
$img . '4a.jpeg',
$img . '5a.jpeg',
$img . '5b.jpeg',
$img . '5c.jpeg',
$img . '6.jpg',
$img . '7.jpg',
);
?>
<div id="heroCarousel" class="custom-hero carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
<!-- 
    <?php $thumb_count = -1; ?>

    <?php  foreach ($thumbnail as $slide) { ?>
    
         <?php $thumb_count++; ?>
   
         <?php if($thumb_count == 0) { $active = "active";  } else { $active = ''; } ?>
   
         <li data-target="#heroCarousel" data-slide-to="<?php echo $thumb_count ?>" class="<?php echo $active; ?>"></li>
  
    <?php } ?> -->

  </ol>


  <div class="carousel-inner" role="listbox">
    <?php
    $count = 0;
    foreach ($thumbnail as $dog) {
    
    $count++;
    
    ?>
    <?php if($count == 1) { $active = "active";  } else { $active = ''; } ?>
    <div class="item <?php echo $active; ?>">
      <div class="hero-custom" style="background-image: url(<?php echo $dog; ?>)">
        <div class="container">
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