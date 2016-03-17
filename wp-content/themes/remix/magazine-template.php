<?php
/**
*Template Name: Magazine Template
*
* @author : VanThemes ( http://www.vanthemes.com )
* @license : GNU General Public License version 2.0
*/


get_header(); 

?>

<div class="container">

<ul class="products">
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 12
			);
		$loop = new WP_Query( $args );

$user_ID = get_current_user_id();
$user_Subscriptions = WC_Subscriptions_Manager::get_users_subscriptions( get_current_user_id() );
$user_group = do_shortcode('[groups_woocommerce_memberships]'); 


		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				// woocommerce_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	?>
</ul><!--/.products-->


<div id="main-content"  class="<?php echo $van_page_type['type'] . ' ' . $van_page_type['container']; ?> error404">

	<div id="single-outer">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array('content','post-inner') ); ?>>
					
					<div class="entry-container">

						<div class="entry-content">

							<div class="magazine-container">

							<?php 

							 $parent = get_page_by_title( 'My Remix', ARRAY_A );
							 $parentID = $parent['ID'];


					

							 $args = array(
	                          'post_parent' => $parentID,
	                          'post_type'   => 'any', 
	                          // 'posts_per_page' => -1,
	                          'post_status' => 'any' 
	                          ); 


							 $my_wp_query = new WP_Query();
                             $all_wp_pages = $my_wp_query->query(array('post_type' => 'page'));


							   $children_array =  get_page_children($parentID, $all_wp_pages);



                               $page_IDs = array();

                               if(count($children_array)){

                               

							   foreach ($children_array  as $item) {

							   	echo "<div class='single_mag'>";
				 
				                 $mag = $item->post_content;

				                 echo "<h1 class='entry-title magazine-title'>$item->post_title</h1>";

				                 echo do_shortcode($mag);

				                 echo "</div>";

							    }


							   } else { ?>

                                  <div class='woocommerce'>
							       <h1 class='entry-title magazine-title'>Pick up your digital copy of Remix!</h1>
							       <a  class='button btn-issue' href='/shop'>Shop Magazines</a>
							      </div>

							

					 <?php	 } ?>
 

							</div>
							 
					

							<?php wp_link_pages(array('before' => '<p><strong>'.__( 'Pages:','van').'</strong> ', 'after' => '</p>')); ?>										
						
							<?php edit_post_link( __( '(Edit)', 'van' ), '<span class="edit-post">', '</span>' ); ?>
				
						</div><!-- .entry-content -->
						
					</div><!-- .entry-container -->

				</article>

			<?php endwhile; ?>

		<?php endif;  ?>
		<?php comments_template( '', true ); ?>

	</div> <!-- #single-outer -->

</div><!-- #main-content -->
</div>

<?php get_footer(); 
?>