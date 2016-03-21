<?php
get_header();
global $post;
$id = $post->ID;
$number = 9613;
$width = ($id == $number) ? 12 :  8;
	
?>
<div class="article-hero" style="background-image: url(<?php echo remix_thumbnail_url($post) ?>)">
	<div class="container">
		<h2><?php echo $post->post_title; ?></h2>
	</div>
</div>
<div class="container">
	<div class="article_single">
		
		<div class="toolbar">
			<span class="article-tag">Category</span>
			<span class="author"><?php echo get_the_author_meta('display_name', $post->post_author); ?></span>
			<span class="date"><?php echo $post->post_date; ?></span>
			<span class="crumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
			</span>
		</div>
		<div class="container-fluid">
			<div class="row article_content">
				<div class="col-md-<?php echo $width ?> content">
					<?php
					if (have_posts()) :
					while (have_posts()) :
					  the_post();
					  the_content();
					 endwhile;
					endif;
					?>
					<div class="sharebtns">
						<?php //echo do_shortcode('[apss_share]'); ?>
					</div>

					  <?php $cat_ID = get_the_category()[0]->cat_ID; ?>

					  <?php $args = array('numberposts' => 3 ,'cat' => $cat_ID, 'status' => 'publish' ); ?>

					  <?php $posts_array = get_posts( $args ); ?>

                 <div class="row">
                 <div class="col-md-12">
                   <h2>More like this</h2>
                   </div>
                  </div>
					  <?php

					  foreach($posts_array as $related) {
					  	article($related);
					  }


					  ?>

				</div>
				<?php if($id != $number) { ?>
				<div class="col-md-4 sidebar">
					<div class="single-editor">
						<?php include('inc/editors-choice.php'); ?>
					</div>
					
					<?php get_sidebar(); ?>
					
					
				</div>
				<?php } ?>
				
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
?>