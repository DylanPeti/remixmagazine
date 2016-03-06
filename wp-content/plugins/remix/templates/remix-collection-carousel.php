<?php
use MetzWeb\Instagram\Instagram;
$class="Remix";

if($_POST) :

$save = $class::create("social", $_POST);

endif;

$submit = "carousel";

$status = "active";
$class = "Remix";

$social = $class::read("social")[0];


$instagram = new Instagram(array(
    'apiKey'      => 'a161a834de38496cbac86a62a441d923',
    'apiSecret'   => '6d2c978b1bfd48caaebef1d508f7500c',
    'apiCallback' => 'http://remixmagazine.dev/'
));



?>




<div class="remix-wrapper">
	<div class="container">
	
	<div class="title">
		<h1>Instagram</h1>

	</div>
<?php $status = "active"; ?>
<?php $data = array(); ?>

<form action="http://remixmagazine.dev/wp-admin/admin.php?page=remix-collection-carousel.php" method="post">

<div class="row">
<div class='col-md-6'>
<div class="remix-sections">
<h4>Settings</h4>
<p>Manage App: <a target="_blank" href="https://www.instagram.com/developer/clients/manage/">www.instagram.com/developer/clients/manage</a></p>
  <fieldset class="form-group">
    <input type="text" name="data['app_key']" class="form-control" id="exampleInputPassword1" placeholder="<?php echo $social->app_key ?>">
  </fieldset>

    <fieldset class="form-group">
    <input type="text" name="data['app_secret']" class="form-control" id="exampleInputPassword1" placeholder="<?php echo $social->app_secret ?>">
  </fieldset>

    <fieldset class="form-group">
    <input type="text" name="data['app_callback']" class="form-control" id="exampleInputPassword1" placeholder="<?php echo $social->app_callback ?>">
  </fieldset>
      <input type="hidden" name="data['provider']" value="instagram">
     <input href="#" name="<?php echo $submit; ?>" class="btn-update" type="submit" value="Update">
    
  </div>
</div>
	
</div>

</div>


    <div class="col-md-6">
        <div class="remix-sections">
        	<div class="row">
        		<div class="col-md-6">
        			<div class="row">
        				<div class="col-md-12">
        				 <div class="details">
        						
        			      <div class="section-title"><h2 class="hero"><?php echo "Media"; ?></h2></div>
        				  <div class="pointer"><i class="fa fa-long-arrow-right"></i></div>
        				  <div class="status <?php echo $status; ?>"><p><?php echo $status; ?></div>
        						
        				  </div>
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-12">
        					<div>
        			    <p><?php echo "Count: 12"; ?></p>
                        <a href="<?php echo $instagram->getLoginUrl();
?>">
 <button class="btn-update">Fetch</button></a>
        				
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
   </div>
   </div>


</div>