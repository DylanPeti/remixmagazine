<?php /* Template Name: Wide */ ?>
<?php

get_header(); 
global $post;

?>
<div class="container">
	<h2 class="about-page-title"><?php echo the_title(); ?></h2>
</div>
<div class="container">
	<div class="article_single">

		<div class="toolbar">
			<span class="crumbs">
			<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
			</span>
		</div>
		  <div class="row article_content">

		   <div class="col-md-12">
		   			
           <?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			the_content(); 
		endwhile;
		?>

		   </div>
		 </div>
	 </div>
</div>

<?php

get_footer(); 

?>