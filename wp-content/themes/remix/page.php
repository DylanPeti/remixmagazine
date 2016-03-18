 <?php

get_header(); 
global $post;

$page = (is_page('cart') ? 12 : 8);
?>
<div class="container">
	<div class="article_single">
		<div class="toolbar">
			<span class="crumbs">
			<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
			</span>
		</div>
		  <div class="row article_content">

		   <div class="col-md-<?php echo $page ?>">
		   			
           <?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			the_content(); 
		endwhile;
		?>

		   </div>
		    <div class="col-md-4 sidebar">

		   </div>
		 </div>
	 </div>
</div>

<?php

get_footer(); 

?>