<div class="remix-wrapper">
   <div class="container">
    <div class="title">
   	  <h1>Adverts</h1>
    </div>
<?php 

$adverts_top = get_adverts("top"); 

$adverts_bottom = get_adverts("bottom"); 

$adverts = array_merge($adverts_top, $adverts_bottom);


?>

<section id="article-section" class="black">
  
  <div class="container">
   
    <div class="article-collection">

    <?php $count = 0; ?>
     
      <?php foreach ($adverts as $item) : ?>

        <?php $count++; ?>
     
         <?php echo advert($item, $count); ?>
       
      <?php endforeach; ?>
      
    </div>

  </div>

</section>

  </div>

</section>



    </div>
    </div>