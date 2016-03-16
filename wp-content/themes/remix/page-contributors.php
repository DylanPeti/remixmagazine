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

                 <div class="col-md-4">
                 <div class="user-profile-card">

                     <div class="avatar"><?php echo get_avatar( $user->user_email , 182 ); ?></div>
                     <p class="name"><?php echo $user->display_name ?></p>
                     <p class="description"><?php echo get_user_meta($user->data->ID)['description'][0] ?></p>
                   <!--   <p class="email"><?php echo $user->user_email ?></p> -->
                     
                 	
                 </div>
                 	
                 </div>
           
          <?php } ?>


</div>
</div>

<?php 

get_footer(); 

?>