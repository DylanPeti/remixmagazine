<?php
use MetzWeb\Instagram\Instagram;
$class="Remix";

if($_POST) :
  if(empty($class::read("social")[0])) {
    $save = $class::create("social", $_POST);
   } else {
    $update = $class::update("social", $_POST);
   }

endif;

$submit = "carousel";

$status = "active";
$class = "Remix";

$social = $class::read("social")[0];

if(!empty($social)) {
$instagram = new Instagram(array(
    'apiKey'      => $social->app_key,
    'apiSecret'   => $social->app_secret,
    'apiCallback' => $social->app_callback,
));
}

if(isset($_GET['code'])) {
    $code = $_GET['code'];

     $data = $instagram->getOAuthToken($code);
     $instagram->setAccessToken($data);

     $datas = array();

     $datas['data']['access_token'] = $data->access_token;
     $datas['id'] = 1;


     $social = $class::update("social", $datas);
    
}

$social = $class::read("social")[0];

?>




<div class="remix-wrapper">
	<div class="container">
	
	<div class="title">
		<h1>Instagram</h1>

	</div>
<?php $status = "active"; ?>
<?php $data = array(); ?>

<form action="<?php echo REMIX_BASE_URL . '/wp-admin/admin.php?page=remix-collection-carousel.php' ?>" method="post">

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

      <?php if(!empty($class::read("social")[0])) { ?>
      <input type="hidden" name="id" value="<?php echo 1; ?>">
      <?php } ?>


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
            <a class="btn-update" href="<?php echo $instagram->getLoginUrl();
?>">Fetch</a>

        				
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
   </div>
   </div>


</div>



