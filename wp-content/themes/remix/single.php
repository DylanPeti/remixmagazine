<?php
get_header();
global $post;
$id = $post->ID;
$number = 9613;
$width = ($id == $number) ? 12 :  8;

$category = get_the_category($post->ID);

$cat = $category[0]->name;
	
?>
<div class="article-hero" style="background-image: url(<?php echo remix_thumbnail_url($post) ?>)">
	<div class="container">
		<h2><?php echo $post->post_title; ?></h2>
	</div>
</div>
<div class="container">
	<div class="article_single">
		
		<div class="toolbar">
			<span class="article-tag"><?php echo $cat; ?></span>
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

					 $words = substr(get_the_content($post->ID), 0, 200);


      
					  ?>

		

		<ul class="single-article entypo-icons">
        <div class="social-btn" id="fbshare" data-share="<?php echo the_permalink(); ?>,<?php the_title(); ?>,<?php echo thumbnail_link($post); ?>, <?php echo $words; ?>">
          <li class="entypo-facebook"><span>Share</span></li>
        </div>
          <div class="social-btn">
        <a class="twitter-mention-button" target="_blank"
             href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&text=<?php echo the_title() ?> - &via=REMIXmagazine">
          <li class="entypo-twitter"><span>Tweet</span>
            
          </li>	
          </a>
        </div>
    

      </ul>


      <?php 
					 endwhile;
					endif;
					?>
			

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