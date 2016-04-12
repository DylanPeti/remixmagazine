<?php
/**
* The template for displaying search results pages.
*
* @package WordPress
* @subpackage Twenty_Fifteen
* @since Twenty Fifteen 1.0
*/
get_header(); ?>
<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php if ( have_posts() ) : ?>
		<div class="container">
	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'You searched for: %s', 'twentyfifteen' ), get_search_query() ); ?></h1>
		</header><!-- .page-header -->
		</div>
			<section id="article-section" class="black">
			
			<div class="container">
			<div class="article-collection">

		<?php while ( have_posts() ) : the_post(); ?>
		
	
				
				
					<?php article($post); ?>
				
	
		<?php

					// End the loop.
					endwhile; ?>

							</div>
							</div>
		</section>

		<div class="container">


				<?php	// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
						'next_text'          => __( 'Next page', 'twentyfifteen' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
					) );
				// If no content, include the "No posts found" template.
		else : ?>
		</div>
		<div class="container">
			<h1>No results found!</h1>
		</div>
		
		<?php endif; ?>
		</main><!-- .site-main -->
		</section><!-- .content-area -->
		<?php get_footer(); ?>