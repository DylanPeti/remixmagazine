<?php

if($_POST) {
$id = $_POST['data']['id'];

  $delete = Remix::delete_advert("adverts", $id);

}
?>

<div class="remix-wrapper display-all-adverts">
   <div class="container">
    <div class="title">
   	  <h1>Adverts</h1>
    </div>
<?php 

$adverts_top = get_adverts("top"); 

$adverts_bottom = get_adverts("bottom"); 

$adverts = array_merge($adverts_top, $adverts_bottom);


?>

<section id="advert-display-section" class="black">
  
  <div class="container">
   
    <div class="col-md-12">
    <div class="remix-sections advert-display">

    <?php $count = 0; ?>
     
      <?php foreach ($adverts as $item) : ?>

        <?php $count++; ?>
     
         <?php echo advert($item, $count); ?>
       
      <?php endforeach; ?>
      
    </div>
    </div>

  </div>

</section>

  </div>




    </div>
