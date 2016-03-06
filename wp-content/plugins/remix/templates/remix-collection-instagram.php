<?php
use MetzWeb\Instagram\Instagram;
?>



<div class="remix-wrapper">
	<div class="container">
	
	<div class="title">
		<h1>Instagram</h1>
	</div>

<?php



$instagram = new Instagram(array(
    'apiKey'      => 'a161a834de38496cbac86a62a441d923',
    'apiSecret'   => '6d2c978b1bfd48caaebef1d508f7500c',
    'apiCallback' => 'http://remixmagazine.dev/'
));

echo $instagram->getLoginUrl();
?>


<div class="row">
<div class='col-md-6'>
<div class="remix-sections">
<h4>Settings</h4>
<p>Manage App: <a target="_blank" href="https://www.instagram.com/developer/clients/manage/">www.instagram.com/developer/clients/manage</a></p>
  <fieldset class="form-group">
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="<?php echo $social->api_key ?>">
  </fieldset>

    <fieldset class="form-group">
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="App Secret">
  </fieldset>

    <fieldset class="form-group">
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="App Callback">
  </fieldset>

  <button class="btn btn-primary">Update</button>
  </div>
</div>
	
</div>



<div class="row">
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
        				
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
   </div>
   </div>

 </div>
</div>