<?php /* Template Name: Contributors */ ?>

<?php

get_header(); 

?>

<div class="contributors-section">
<div class="container">
<h2><?php the_title(); ?></h2>
		<div class="toolbar">
			<span class="crumbs">
				<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
			</span>
		</div>

		<?php
           $blogusers = get_users( 'blog_id=1&orderby=nicename&role=author' );

           foreach ( $blogusers as $user ) { ?>

                 <div class="col-md-2">
                 <div class="user-profile-card">
                 <a href="<?php echo get_author_posts_url($user->data->ID); ?>">

                 <?php 

                 $args = array(
                  'size' => 136,
                  'force_default'  => false,
                  );
             
               $args = get_avatar_data( $user->data->ID, $args);

               $url = $args['url'];


                  ?>

                     <div class="single-avatar" style="background-image: url(<?php echo $url ?>)"></div>
                     <p class="name"><?php echo $user->display_name ?></p>


                 </div>
                 	
                 </div>
           
          <?php } ?>


</div>
</div>

<?php 

get_footer(); 

?>