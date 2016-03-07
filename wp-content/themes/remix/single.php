<?php

get_header(); 
global $post
?>

<div class="article-hero">
	<div class="container">
		<h2><?php echo $post->post_title; ?></h2>	
	</div>
</div>
<div class="container">
	<div class="article_single">
	
	<div class="toolbar">
		<span class="article-tag">Category</span>
		<span class="author"><?php echo remix_post_author($post->ID); ?></span>
		<span class="date"><?php echo $post->post_date; ?></span>
		<span class="crumbs">
		<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
		</span>
	</div>
	  <div class="row article_content">

	   <div class="col-md-8 content">
	   			
		<?php echo $post->post_content; ?>

		<div class="sharebtns">
			<?php echo do_shortcode('[apss_share]'); ?>			
		</div>

	   </div>
	    <div class="col-md-4 sidebar">
	    
	    	 <div class="ad">
		    	<div class="ad-img"></div>
		    	<div class="ad-content">
					<h2>Title Of Ad Here</h2>
				 	<p>Cal To Action Here</p>
				 	<span class="ad-tag">PROMOTION</span>
				 	<button class="ad-btn">Learn More</button>
				 </div>
			</div>

			<article class="article">
		      	<div class=" article-img" style="background-image: url(<?php echo remix_thumbnail_url($article->name, 'cat') ?>)">
		      	</div>
				 <div class="article_exerpt">
				  	<span class="article-tag <?php echo $cat_class; ?>"><?php echo $article->name; ?></span>
			 	<h2><?php echo remix_post_title($article->name); ?></h2>
			 	<span class="author"><?php echo remix_post_author($article->name); ?></span>
			 	<ul class="entypo-icons">
	             <li class="entypo-facebook"></li>
	             <li class="entypo-twitter"></li>
	            </ul>
			</div>

      </article>
      
      <?php get_sidebar(); ?>

	   </div>
	 </div>
	 </div>
</div>

<?php

get_footer(); 

?>