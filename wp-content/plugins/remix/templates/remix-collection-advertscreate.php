<?php

if($_POST) :
$save = Remix::create("adverts", $_POST);
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

$data = array();
?>
<section id="advert-create-section" class="black">
	<div class="container">
		<div class="title">
			<h1>Adverts</h1>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				
				<div class="remix-sections create-advert">
					<div class="col-md-6">
						<h3>Create</h3>
						<form action="<?php echo REMIX_BASE_URL . '/wp-admin/admin.php?page=remix-collection-advertscreate.php' ?>" method="post">
							
							<div class="form-group">
								<input name="data['title']" class="create-title-input" type="text" name="title" placeholder="Advert title">
							</div>
							<div class="form-group">
								<input name="data['link']" class="create-title-input" type="text" name="title" placeholder="Link to website">
							</div>
							<div class="preview"></div>
							<div class="form-group">

							 <input class="data-image" type="hidden" name="data['image']" value="">
							 <input class="data-status" type="hidden" name="data['status']" value="active">
							 <input class="data-location" type="hidden" name="data['location']" value="top">
							 <input class="data-position" type="hidden" name="data['position']" value="">
								<a href="#" class="btn-update upload-media">Upload Media</a>
								<button class="btn btn-update" type="submit">Submit</button>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<div class="col-md-12">
							<h3>Location</h3>
						</div>
						<div class="preview-advert">
							<?php
							$articles = get_articles(0, array($recent_post[0]->ID));
							$count = 0;
							//$articles = $get_the_articles; ?>
							<div class="col-md-3"><h4>TOP</h4></div>
							<div class="col-md-6">
								<div class="slot-section">
									<?php foreach ($articles as $article) { ?>
									<?php $count++; ?>
									<?php $cross = ($count == 4 ? "cross" : ""); ?>
									
									<div class="slot <?php echo $cross; ?>" data-pos="<?php echo $count; ?>"></div>
									
									<?php } ?>
								</div>
							</div>
							<div class="col-md-3"><h4 class="pos-number">0</h4></div>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
			</div>
		</div>
	</div>
</section>