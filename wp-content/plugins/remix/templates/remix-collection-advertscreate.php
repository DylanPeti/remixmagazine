<?php

if($_POST) :
    
     $data = $_POST['data'];

     $position = $_POST['data']['position'];
     $location = $_POST['data']['location'];
     
     $adverts = get_adverts($location);

     $pos = array();
     
     foreach($adverts as $ad) {
       $pos[$ad->id] = $ad->position;
     }

     if (false !== $key = array_search($position, $pos)) {
       $save = Remix::replace("adverts", $_POST, $key);
      } else {
       $save = Remix::create("adverts", $_POST);
      }

endif;


$recent_posts = array(
'numberposts' => 1,
'offset' => 0,
'category' => 0,
'orderby' => 'post_date',
'order' => 'DESC',
'post_type' => 'post',
'post_status' => 'publish',
'suppress_filters' => true
);
$count = 0;
$recent_post = wp_get_recent_posts( $recent_posts, OBJECT);
$articles = get_articles(0, array($recent_post[0]->ID));
$data = array();
?>
<section id="advert-create-section" class="black">
	<div class="title">
		<h1>ADVERT BUILDER</h1>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="remix-sections advert-creator">
				
				
				<form action="<?php echo REMIX_BASE_URL . '/wp-admin/admin.php?page=remix-collection-advertscreate.php' ?>" method="post">
					<div class="create-advert">
						<?php if($_POST) : ?>
						<div class="message-success">Advert created</div>
						<?php endif; ?>
						<h3>CREATE</h3>
						<div class="form-group">
							<input name="data[title]" class="create-title create-title-input" type="text" name="title" placeholder="Advert title" required>
						</div>
						<div class="form-group">
							<input name="data[link]" class="create-link create-title-input" type="text" name="title" placeholder="Link to website" required>
						</div>
						<div class="form-group">
							<label for="sel1">Choose a Location</label>
							<select name="data[location]" class="form-control" id="sel1" selected="selected">
								<option value="top" selected>Top</option>
								<option value="bottom">Bottom</option>
							</select>
						</div>
						
						<div class="form-group">
							<div class="preview"></div>
							<p class="img-note">Note: if you see space inside the dotted lines, you'll need
							to resize the advert image. Ideal dimensions are: 300 x 250</p>
							<input class="data-image" type="hidden" name="data[image]" value="">
							<input class="data-status" type="hidden" name="data[status]" value="active">
							
							<a href="#" class="btn-update upload-media">Upload Media</a>
							
						</div>
						<p class="warning">Finish creating the advert before proceeding</p>
						<a href="#" class="btn-update next">NEXT</a>
					</div>


					<div class="choose-location">
						<div class="location-title"><h2>TOP</h2></div>
						<div class="article-collection">
							<?php $count = 0; ?>
							<?php foreach ($articles as $item) : ?>
							
							<?php
							$count++;
							$exclude = array();
							foreach (get_adverts("top") as $advert) {
							$exclude[] = $advert->position;
							if($advert->position == $count) {
							echo advert($advert, $count);
							continue;
							}
							}
							if(in_array($count, $exclude)){
							continue;
							}
							article($item, null, $count);
							?>
							
							<?php endforeach; ?>
						</div>
						<input class="data-position" type="hidden" name="data[position]" value="">
						<button class="btn-update submit" type="submit">Create Advert</button>
						
					</div>

					<div class="choose-location-bottom">
						<div class="location-title"><h2>Bottom</h2></div>
						<div class="article-collection">`
							<?php $count = 0; ?>
							<?php foreach ($articles as $item) : ?>
							
							<?php
							$count++;
							$exclude = array();
							foreach (get_adverts("bottom") as $advert) {
							$exclude[] = $advert->position;
							if($advert->position == $count) {
							echo advert($advert, $count);
							continue;
							}
							}
							if(in_array($count, $exclude)){
							continue;
							}
							article($item, null, $count);
							?>
							
							<?php endforeach; ?>
						</div>
						<input class="data-position" type="hidden" name="data[position]" value="">
						<button class="btn-update submit" type="submit">Create Advert</button>
						
					</div>


				</form>
				
			</div>
		</div>
	</div>
	
</section>